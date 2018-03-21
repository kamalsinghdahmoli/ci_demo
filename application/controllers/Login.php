<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
     
    
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'teacher/dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'student/dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'parents/dashboard', 'refresh');

        if ($this->session->userdata('librarian_login') == 1)
            redirect(base_url() . 'librarian/dashboard', 'refresh');

        if ($this->session->userdata('accountant_login') == 1)
            redirect(base_url() . 'accountant/dashboard', 'refresh');

        $this->load->view('backend/login');
    }

    //Validating login from ajax request
    function validate_login() {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $credential = array('email' => $email, 'password' => sha1($password));
      // Checking login credential for admin
      $query = $this->db->get_where('admin', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('admin_login', '1');
          $this->session->set_userdata('admin_id', $row->admin_id);
          $this->session->set_userdata('login_user_id', $row->admin_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'admin');
          redirect(base_url() . 'admin/dashboard', 'refresh');
      }

      // Checking login credential for teacher
      $query = $this->db->get_where('teacher', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('teacher_login', '1');
          $this->session->set_userdata('teacher_id', $row->teacher_id);
          $this->session->set_userdata('login_user_id', $row->teacher_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'teacher');
          redirect(base_url() . 'teacher/dashboard', 'refresh');
      }

      // Checking login credential for student
      $query = $this->db->get_where('student', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('student_login', '1');
          $this->session->set_userdata('student_id', $row->student_id);
          $this->session->set_userdata('login_user_id', $row->student_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'student');
          redirect(base_url() . 'student/dashboard', 'refresh');
      }

      // Checking login credential for parent
      $query = $this->db->get_where('parent', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('parent_login', '1');
          $this->session->set_userdata('parent_id', $row->parent_id);
          $this->session->set_userdata('login_user_id', $row->parent_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'parent');
          redirect(base_url() . 'parents/dashboard', 'refresh');
      }

      // Checking login credential for librarian
      $query = $this->db->get_where('librarian', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('librarian_login', '1');
          $this->session->set_userdata('librarian_id', $row->librarian_id);
          $this->session->set_userdata('login_user_id', $row->librarian_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'librarian');
          redirect(base_url() . 'librarian/dashboard', 'refresh');
      }

      // Checking login credential for accountant
      $query = $this->db->get_where('accountant', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('accountant_login', '1');
          $this->session->set_userdata('accountant_id', $row->accountant_id);
          $this->session->set_userdata('login_user_id', $row->accountant_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'accountant');
          redirect(base_url() . 'accountant/dashboard', 'refresh');
      }

      $this->session->set_flashdata('login_error', get_phrase('invalid_login'));
      redirect(base_url() . 'login', 'refresh');
    }


public function gettoken()
{

  // Authorization code should be in the "code" query param
  if (isset($_GET['code'])) {
    // Check that state matches
    if (isset($_GET['state']) && isset($_SESSION['oauth_state'])) {
      if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth_state'])) {
        exit('State provided in redirect does not match expected value.');
      }  
      // Clear saved state
      unset($_SESSION['oauth_state']);  
    }

    // Initialize the OAuth client
     $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => $this->config->item('OAUTH_APP_ID'),
        'clientSecret'            => $this->config->item('OAUTH_APP_PASSWORD'),
        'redirectUri'             => $this->config->item('OAUTH_REDIRECT_URI'),
        'urlAuthorize'            => $this->config->item('OAUTH_AUTHORITY').$this->config->item('OAUTH_AUTHORIZE_ENDPOINT'),
        'urlAccessToken'          => $this->config->item('OAUTH_AUTHORITY').$this->config->item('OAUTH_TOKEN_ENDPOINT'),
        'urlResourceOwnerDetails' => '',
        'scopes'                  => $this->config->item('OAUTH_SCOPES')
      ]);

    try {

      // Make the token request
      $accessToken = $oauthClient->getAccessToken('authorization_code', [
        'code' => $_GET['code']
      ]);

      //echo 'Access token: '.$accessToken->getToken();
      return $accessToken->getToken();
    }
    catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
      exit('ERROR getting tokens: '.$e->getMessage());
    }
    exit();
  }
  elseif (isset($_GET['error'])) {
    exit('ERROR: '.$_GET['error'].' - '.$_GET['error_description']);
  }
}


    public function microsoftLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }

        // Initialize the OAuth client
        $oauthClient = new League\OAuth2\Client\Provider\GenericProvider([
          'clientId'                => $this->config->item('OAUTH_APP_ID'),
          'clientSecret'            => $this->config->item('OAUTH_APP_PASSWORD'),
          'redirectUri'             => $this->config->item('OAUTH_REDIRECT_URI'),
          'urlAuthorize'            => $this->config->item('OAUTH_AUTHORITY').$this->config->item('OAUTH_AUTHORIZE_ENDPOINT'),
          'urlAccessToken'          => $this->config->item('OAUTH_AUTHORITY').$this->config->item('OAUTH_TOKEN_ENDPOINT'),
          'urlResourceOwnerDetails' => '',
          'scopes'                  => $this->config->item('OAUTH_SCOPES')
        ]);

        // Generate the auth URL
        $authorizationUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in response
        $_SESSION['oauth_state'] = $oauthClient->getState();

        // Redirect to authorization endpoint
        header('Location: '.$authorizationUrl);

    }

      function checkLogin(){
          $token = $this->gettoken();
          $_SESSION['access_token'] = $token;
          $_SESSION['access_code'] = $_GET['code'];
          
          $graph = new Graph();
          $graph->setAccessToken($token);
          $usera = $graph->createRequest('GET', '/me')
                        ->setReturnType(Model\User::class)
                        ->execute();
      
          $email = $usera->getMail();
          if (!empty($email) || $email != NULL) {
            $email = $usera->getMail();
          }else{
            $email = $usera->getuserPrincipalName();
          }

          if (empty($email)) {
              $this->session->set_flashdata('login_error', get_phrase('invalid_login'));
              redirect(base_url() . 'login', 'refresh');
          }

         
          $credential = array('email' => $email);
          // Checking login credential for admin
          $query = $this->db->get_where('admin', $credential);
          if ($query->num_rows() > 0) {
              $row = $query->row();
              $this->session->set_userdata('admin_login', '1');
              $this->session->set_userdata('admin_id', $row->admin_id);
              $this->session->set_userdata('login_user_id', $row->admin_id);
              $this->session->set_userdata('name', $row->name);
              $this->session->set_userdata('login_type', 'admin');
              redirect(base_url() . 'admin/dashboard', 'refresh');
          }

          // Checking login credential for teacher
          $query = $this->db->get_where('teacher', $credential);
          if ($query->num_rows() > 0) {
              $row = $query->row();
              $this->session->set_userdata('teacher_login', '1');
              $this->session->set_userdata('teacher_id', $row->teacher_id);
              $this->session->set_userdata('login_user_id', $row->teacher_id);
              $this->session->set_userdata('name', $row->name);
              $this->session->set_userdata('login_type', 'teacher');
              redirect(base_url() . 'teacher/dashboard', 'refresh');
          }

          // Checking login credential for student
          $query = $this->db->get_where('student', $credential);
          if ($query->num_rows() > 0) {
              $row = $query->row();
              $this->session->set_userdata('student_login', '1');
              $this->session->set_userdata('student_id', $row->student_id);
              $this->session->set_userdata('login_user_id', $row->student_id);
              $this->session->set_userdata('name', $row->name);
              $this->session->set_userdata('login_type', 'student');
              redirect(base_url() . 'student/dashboard', 'refresh');
          }

          // Checking login credential for parent
          $query = $this->db->get_where('parent', $credential);
          if ($query->num_rows() > 0) {
              $row = $query->row();
              $this->session->set_userdata('parent_login', '1');
              $this->session->set_userdata('parent_id', $row->parent_id);
              $this->session->set_userdata('login_user_id', $row->parent_id);
              $this->session->set_userdata('name', $row->name);
              $this->session->set_userdata('login_type', 'parent');
              redirect(base_url() . 'parents/dashboard', 'refresh');
          }

          // Checking login credential for librarian
          $query = $this->db->get_where('librarian', $credential);
          if ($query->num_rows() > 0) {
              $row = $query->row();
              $this->session->set_userdata('librarian_login', '1');
              $this->session->set_userdata('librarian_id', $row->librarian_id);
              $this->session->set_userdata('login_user_id', $row->librarian_id);
              $this->session->set_userdata('name', $row->name);
              $this->session->set_userdata('login_type', 'librarian');
              redirect(base_url() . 'librarian/dashboard', 'refresh');
          }

          // Checking login credential for accountant
          $query = $this->db->get_where('accountant', $credential);
          if ($query->num_rows() > 0) {
              $row = $query->row();
              $this->session->set_userdata('accountant_login', '1');
              $this->session->set_userdata('accountant_id', $row->accountant_id);
              $this->session->set_userdata('login_user_id', $row->accountant_id);
              $this->session->set_userdata('name', $row->name);
              $this->session->set_userdata('login_type', 'accountant');
              redirect(base_url() . 'accountant/dashboard', 'refresh');
          }

          $this->session->set_flashdata('login_error', get_phrase('invalid_login'));
          redirect(base_url() . 'login', 'refresh');




      }






    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function reset_password()
    {
        $email = $this->input->post('email');
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'login/forgot_password', 'refresh');
        }
        // Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'login/forgot_password', 'refresh');
        }
        // Checking credential for teacher
        $query = $this->db->get_where('teacher' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'teacher';
            $this->db->where('email' , $email);
            $this->db->update('teacher' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'login/forgot_password', 'refresh');
        }
        // Checking credential for parent
        $query = $this->db->get_where('parent' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'parent';
            $this->db->where('email' , $email);
            $this->db->update('parent' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'login/forgot_password', 'refresh');
        }
        $this->session->set_flashdata('reset_error', get_phrase('password_reset_was_failed'));
        redirect(base_url() . 'login/forgot_password', 'refresh');
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'login', 'refresh');
    }



    /*Hybrid Social Logins*/

     public function window($provider_id)
    {
      if (empty($provider_id)) {
        redirect('members/register');
      }

      $params = array(
        'hauth_return_to' => site_url("members/window/{$provider_id}"),
      );
      if (isset($_REQUEST['openid_identifier']))
      {
        $params['openid_identifier'] = $_REQUEST['openid_identifier'];
      }
      try
      {
        $adapter = $this->hybridauthlib->HA->authenticate($provider_id, $params);
        $profile = $adapter->getUserProfile();

        if ($profile) {
          $user = $this->db->where('email', $profile->email)->get('users')->row_array();
          
          if (is_array($user) && count($user > 0)) {
          
          if ($user['active'] == 0)
          {
            $this->session->set_flashdata('message', "Profile is deactivated!");
                redirect('members/register');
          }
          $session_data = array(
              'identity'             => $user['email'],
              'username'             => $user['username'],
              'email'                => $user['email'],
              'user_id'              => $user['id'], //everyone likes to overwrite id so we'll use user_id
              'old_last_login'       => $user['last_login'],
              //'provider'         => $user['provider_id'],
              //'provider_uid'       => $user['identifier'],
          );
          
          $this->session->set_userdata($session_data);

          $admin = 'admin';
          $member = 'members';
          $managers = 'managers';
          $operator = 'operator';

          if ($this->ion_auth->in_group($admin)) // user can be in multiple groups like admin, operator, gymowner
          {
            redirect(base_url().'admin/dashboard', 'refresh');
          }elseif ($this->ion_auth->in_group($operator)){

            $this->session->set_userdata('userrole', $operator);
            redirect(base_url()."operators", 'refresh');
          }elseif ($this->ion_auth->in_group($member)){

            $this->session->set_userdata('userrole', $member);
            redirect(base_url()."members/dashboard", 'refresh');
          }elseif ($this->ion_auth->in_group($managers)) {
            $this->session->set_userdata('userrole', $managers);
            redirect(base_url().'managers', 'refresh');
          }else{
            $this->ion_auth->logout();
            redirect('members/login', 'refresh');
          }


          }else{
          $email    = strtolower($profile->email);
          $identity = $profile->email;
          $length = 8;
          $password = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

          
          $additional_data = array(
              'first_name' => $profile->firstName,
              'last_name'  => $profile->lastName,
              //'company'    => $this->input->post('company'),
              'phone'      => $profile->phone,
              
          );



        if ($this->ion_auth->register($identity, $password, $email, $additional_data))
        {

              $user = $this->db->where('email', $email)->get('users')->row_array();
          $this->session->set_userdata("username", $profile->firstName."&nbsp;".$profile->lastName);
          $session_data = array(
              'identity'             => $user['email'],
              'username'             => $user['username'],
              'email'                => $user['email'],
              'user_id'              => $user['id'], //everyone likes to overwrite id so we'll use user_id
              'old_last_login'       => $user['last_login'],
             // 'provider'         => $user['provider_id'],
              //  'provider_uid'       => $user['identifier'],
          );
          $this->session->set_userdata($session_data);

          $active = array('active' => 1);
          $this->db->where('email', $email);
          $this->db->update('users', $active);
          
          $admin = 'admin';
          $member = 'members';
          $managers = 'managers';
          $operator = 'operator';

          if ($this->ion_auth->in_group($admin)) // user can be in multiple groups like admin, operator, gymowner
          {
            redirect(base_url().'admin/dashboard', 'refresh');
          }elseif ($this->ion_auth->in_group($operator)){

            $this->session->set_userdata('userrole', $operator);
            redirect(base_url()."operators", 'refresh');
          }elseif ($this->ion_auth->in_group($member)){

            $this->session->set_userdata('userrole', $member);
            redirect(base_url()."members/dashboard", 'refresh');
          }elseif ($this->ion_auth->in_group($managers)) {
            $this->session->set_userdata('userrole', $managers);
            redirect(base_url().'managers', 'refresh');
          }else{
            $this->ion_auth->logout();
            redirect('members/login', 'refresh');
          }
        }else{
          echo "inside reg string";
          exit();
          $this->session->set_flashdata('message', "Unable to register");
              redirect('members/register'); 
        }

          

        }
          }else{
            $this->session->set_flashdata('message', "Profile not existed in social network");
            redirect('members/register');
          }
      }
      catch (Exception $e)
      {
        show_error($e->getMessage());
      }
    }

   /**
   * Handle the OpenID and OAuth endpoint
   */
  public function endpoint()
  {
    $this->hybridauthlib->process();
  }





}
