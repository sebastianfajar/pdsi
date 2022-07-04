<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Survey_model');
        $this->load->model('Saker_model');
        $this->load->model('Question_model');
    }


    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/user_footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/user_footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Access Changed </div>');
    }

    public function delete($id)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Role removed </div>');
        redirect('admin/role');
    }

    public function editrole()
    {
        $data['title'] = 'Edit Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/user_footer');
        } else {
            $data = [
                'role' => $this->input->post('role'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_role', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Role Changed</div>');
            redirect('admin/role');
        }
    }

    public function servicemanagement()
    {
        $data = [
            'title' => 'Management Survey',
            'user' => $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array(),
            'get_group' => $this->Survey_model->get_group(),
            'get_saker' => $this->Saker_model->getSaker(),
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/service_management/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function add_group_layanan()
    {
        $saker_id = $this->input->post('saker_id');
        $group_layanan = $this->input->post('group_layanan');

        $data = array(
            'saker_id' => $saker_id,
            'group_layanan' => $group_layanan,
        );

        $this->Survey_model->addGroupLayanan($data, 'survey_group');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Add new Group Layanan</div>');
        redirect('admin/servicemanagement');
    }

    public function update_group_layanan()
    {
        $id = $this->input->post('id');
        $saker_id = $this->input->post('saker_id');
        $group_layanan = $this->input->post('group_layanan');

        $data = array(
            'saker_id' => $saker_id,
            'group_layanan' => $group_layanan,
        );

        $where = array(
            'id' => $id,
        );

        $this->Survey_model->updateGroupLayanan($where, $data, 'survey_group');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Group Layanan Changed</div>');
        redirect('admin/servicemanagement');
    }

    public function destroy_group_layanan($id)
    {
        $where = array('id' => $id);
        $this->Survey_model->destroyGroupLayanan($where, 'survey_group');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Removed successfull </div>');
        redirect('admin/servicemanagement');
    }

    public function saker()
    {
        $data = [
            'title' => 'Satuan Kerja',
            'user' => $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array(),
            'get_saker' => $this->Saker_model->getSaker(),
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/saker/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function add_satuankerja()
    {
        $name = $this->input->post('name');

        $data = array(
            'name' => $name,
        );

        $this->Saker_model->addSaker($data, 'saker');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Add new Satuan Kerja</div>');
        redirect('admin/saker');
    }

    public function update_satuankerja()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        $data = array(
            'name' => $name,
        );

        $where = array(
            'id' => $id,
        );

        $this->Saker_model->updateSaker($where, $data, 'saker');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Satuan Kerja Changed</div>');
        redirect('admin/saker');
    }

    public function destroy_satuankerja($id)
    {
        $where = array('id' => $id);
        $this->Saker_model->destroySaker($where, 'saker');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Removed successfull </div>');
        redirect('admin/saker');
    }

    public function question()
    {
        $data = [
            'title' => 'New Question',
            'user' => $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array(),
            'get_question' => $this->Question_model->getQuestion(),
            'get_saker' => $this->Saker_model->getSaker(),
            'get_group' => $this->Survey_model->get_group(),
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/question/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function add_question()
    {
        $user_id = $this->input->post('user_id');
        $saker_id = $this->input->post('saker_id');
        $group_id = $this->input->post('group_id');
        $question = $this->input->post('question');

        $data = array(
            'user_id' => $user_id,
            'saker_id' => $saker_id,
            'group_id' => $group_id,
            'question' => $question,
        );

        $this->Question_model->addQuestion($data, 'survey_question');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Question Added</div>');
        redirect('admin/question');
    }

    public function update_question()
    {
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $saker_id = $this->input->post('saker_id');
        $group_id = $this->input->post('group_id');
        $question = $this->input->post('question');

        $data = array(
            'user_id' => $user_id,
            'saker_id' => $saker_id,
            'group_id' => $group_id,
            'question' => $question,
        );

        $where = array(
            'id' => $id,
        );

        $this->Question_model->updateQuestion($where, $data, 'survey_question');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Question Changed</div>');
        redirect('admin/question');
    }

    public function destroy_question($id)
    {
        $where = array('id' => $id);
        $this->Question_model->destroyQuestion($where, 'survey_question');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Removed successfull </div>');
        redirect('admin/question');
    }
}
