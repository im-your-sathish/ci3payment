<?php
defined('BASEPATH') or exit('No direct script access allowed');
require("libraries/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;

class User extends CI_Controller
{
	private $key = "xxxxxxxxxxxxxxxxxxxxxxxx";
	private $secret = "xxxxxxxxxxxxxxxxxxxxxxxx";
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		date_default_timezone_set("Asia/Kolkata");
	}
	public function dashboard()
	{
		$api = new Api($this->key, $this->secret);

		$test = $api->payment->fetch("pay_ILDeGZgg0XuHSu")->capture(array('amount' => "70000", 'currency' => 'INR'));
		print_r($test);


		// $api->order->fetch("order_IL33Xwnt9SVulr")->edit(array('notes'=> array('notes_key_1'=>'Beam me up Scotty. 1', 'notes_key_2'=>'Engage')));
		// $orders = $api->order->create(
		// 	['receipt' => '123', 
		// 'amount' => 1000, 
		// 'currency' => 'INR', 
		// 'notes' => ['key1' => 'burri sathish', 'key2' => 'reddy']
		// ]);
		// $orders = $api->order->fetch("order_IBwVHeeHC61IUh")->payments();
		// echo "<pre>";
		// $orders = $api->payment->all();
		// print_r($orders);

		// $orders = $api->order->fetch("order_IL1LavPbm0QAbb");
		// print_r($orders["id"]);
	}

	public function index()
	{
		$result['users'] = $this->u->getusers();
	}

	public function register()
	{
		$this->load->view('register');
	}
	public function login()
	{
		$this->load->view('login');
	}
	public function adduser()
	{

		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';

		$this->load->library("upload", $config);

		if ($this->upload->do_upload('pic')) {

			if ($this->input->post('submit')) {

				$data = [
					'name' => $this->input->post('name'),
					'email' =>  $this->input->post('email'),
					'password' => $this->input->post('password'),
					'photo' => $this->upload->data("file_name")
				];

				if ($this->db->insert('users', $data)) {

					$this->session->set_flashdata('msg', 'Register success plz login');

					redirect(base_url() . "login");
				}
			}
		} else {

			if ($this->input->post('submit')) {

				$data = [
					'name' => $this->input->post('name'),
					'email' =>  $this->input->post('email'),
					'password' => $this->input->post('password')
				];

				if ($this->db->insert('users', $data)) {

					$this->session->set_flashdata('msg', 'Register success plz login');

					redirect(base_url() . "login");
				}
			}
		}
	}

	public function delete()
	{
		$id = $this->input->get('id');
		$user = $this->db->where("id", $id)->get("users")->row();
		unlink("./uploads/" . $user->photo);
		$result  = $this->db->where('id', $id)->delete('users');
		if ($result) {
			redirect("http://localhost/class/miniproject/");
		}
	}

	public function fullview($id)
	{
		$result = $this->db->where('id', $id)->get("users")->row();
		echo $result->name . "<br>";
		echo $result->email . "<br>";
	}

	public function getbyid($id)
	{
		$result["user"] =	$this->u->getbyid($id);
		$this->load->view("edit", $result);
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = [
			'name' => $this->input->post('name'),
			'email' =>  $this->input->post('email'),
			'password' => $this->input->post('password')
		];

		$result = $this->u->updateuser($id, $data);

		if ($result) {
			redirect(base_url() . "user/index");
		} else {
			echo "unable to update";
		}
	}

	public function logincheck()
	{
		$email = $this->input->post("email");
		$password =  $this->input->post("password");

		$query = $this->db->where([
			"email" => $email,
			"password" => $password
		]);

		$result =	$query->get("users")->row();

		if ($result == null) {
			echo "Invalid credentials";
		} else {

			$this->session->id = $result->id;
			$this->session->abc = $result->name;

			redirect("user/books");
		}
	}


	public function books()
	{
		$data["books"] =  $this->db->get("books")->result();
		$this->load->view("bookslist", $data);
	}


	// cart

	public function addtocart()
	{
		$data = [
			"uid" => $this->session->id,
			"pid" => $this->input->get("pid"),
			"quantity" => $this->input->get("quantity"),
		];

		$test = $this->db->where(["uid" => $this->session->id, "pid" => $data['pid']])->get('cart')->row();

		if ($test) {
			$q = $test->quantity + $data["quantity"];
			$this->db->where("cid", $test->cid)->update("cart", ["quantity" => $q]);
		} else {
			$this->db->insert("cart", $data);
		}

		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function deletefromcart($cid)
	{
		$this->db->where("cid", $cid)->delete("cart");
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function cart()
	{
		$this->load->view("cart");
	}

	public function qdec($cid)
	{
		$r = $this->db->where("cid", $cid)->get('cart')->row();
		$this->db->where("cid", $cid)->update("cart", ["quantity" => $r->quantity - 1]);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function qinc($cid)
	{
		$r = $this->db->where("cid", $cid)->get('cart')->row();
		$this->db->where("cid", $cid)->update("cart", ["quantity" => $r->quantity + 1]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	// orders
	public function orders()
	{
		$this->load->view("orders");
	}
	public function placeorder()
	{
		$total = $this->input->get("total");
		$address = $this->input->get("address");
		$pmid = $this->input->get("pmid");

		// die;
		$oid =  date("Ymdhis");

		if ($this->input->get("pmid")) {
			$api = new Api($this->key, $this->secret);
			$capture = $api->payment->fetch($pmid)->capture(array('amount' => $total * 100, 'currency' => 'INR'));

			// $api->payment->fetch($pmid)->edit(array('notes' => array('userid' => $this->session->id, 'address' => $address)));

			$pdetails = $api->payment->fetch($pmid);
			$this->db->insert(
				"orders",
				[
					"orderid" => $oid,
					"uid" => $this->session->id,
					"total" => $total,
					"address" => $address,
					"payment_id" => $pmid,
					"payment_method" => $pdetails->method,
					"payment_status" => $pdetails->status,
					"status" => "Not delivered yet"

				]
			);
		} else {
			$this->db->insert(
				"orders",
				[
					"orderid" => $oid,
					"uid" => $this->session->id,
					"total" => $total,
					"address" => $address,
					"payment_method" => "COD",
					"status" => "Not delivered yet"
				]
			);
		}

		$cart = $this->db->where("uid", $this->session->id)->get("cart")->result();
		foreach ($cart as $c) {
			$this->db->insert("ordereditems", ["orderid" => $oid, "pid" => $c->pid, "quantity" => $c->quantity]);
			$this->db->where("cid", $c->cid)->delete("cart");
		}
		redirect(base_url() . "user/orders");
	}

	public function orderdetails($id)
	{
		$result = $this->db->where('orderid', $id)->get("ordereditems")->result();
		echo '<a href="' . base_url() . 'user/orders">Go Back</a>';

		echo "<center>Orderid-$id<table border=1>";
		echo "<tr>";
		echo "<td>Book Name</td>";
		echo "<td>Book Price</td>";
		echo "<td>Book Quantity</td>";
		echo "<td>Book Quantity</td>";
		echo "</tr>";
		foreach ($result as $row) {
			$row2 = $this->db->where("id", $row->pid)->get("books")->row();
			echo "<tr>";
			echo "<td>" . $row2->bname . "</td>";
			echo "<td>" . $row2->bprice . "</td>";
			echo "<td>" . $row->quantity . "</td>";
			echo "<td>" . $row2->bprice * $row->quantity . "</td>";
			echo "</tr>";
		}
		$row3 = $this->db->where("orderid", $id)->get("orders")->row();

		echo "<tr>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td>Total</td>";
		echo "<td>" . $row3->total . "</td>";
		echo "</tr>";
		echo "</table></center>";
	}


	public function logout()
	{
		session_destroy();
		Redirect(base_url() . "login");
	}
}
