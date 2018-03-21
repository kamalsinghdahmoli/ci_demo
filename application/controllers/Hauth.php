<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hauth Controller Class
 */
class Hauth extends CI_Controller {

  /**
   * {@inheritdoc}
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->helper('url');
    $this->load->library('hybridauth');
  }

  /**
   * {@inheritdoc}
   */
  public function index()
  {
    // Build a list of enabled providers.
    $providers = array();
    foreach ($this->hybridauth->HA->getProviders() as $provider_id => $params)
    {
      $providers[] = anchor("hauth/window/{$provider_id}", $provider_id);
    }

    $this->load->view('hauth/login_widget', array(
      'providers' => $providers,
    ));
  }

  /**
   * Try to authenticate the user with a given provider
   *
   * @param string $provider_id Define provider to login
   */
   public function window($provider_id)
    {
      if (empty($provider_id)) {
        redirect('login');
      }

      $params = array(
        'hauth_return_to' => site_url("hauth/window/{$provider_id}"),
      );
      if (isset($_REQUEST['openid_identifier']))
      {
        $params['openid_identifier'] = $_REQUEST['openid_identifier'];
      }
      try
      {
     
        $adapter = $this->hybridauth->HA->authenticate($provider_id, $params);
        
        $profile = $adapter->getUserProfile();

        if ($profile) {
          $user = $this->db->where('email', $profile->email)->get('users')->row_array();
          
          if (is_array($user) && count($user > 0)) {
          
          if ($user['active'] == 0)
          {
            $this->session->set_flashdata('message', "Profile is deactivated!");
               // redirect('hauth/register');
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

    
    $this->hybridauth->process();
  }



}
