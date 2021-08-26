<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{


    function getCoach($where)
    {
        return $this->db->get_where('coach', $where);
    }

    function getCoachee($where)
    {
        return $this->db->get_where('coachee', $where);
    }
    public function getEmailCoach($email)
    {
        $coach = $this->db->get_where('coach', array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $coach->row();
            return $row;
        }
    }
    public function getEmailCoachee($email)
    {
        $coachee = $this->db->get_where('coachee', array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $coachee->row();
            return $row;
        }
    }
    public function getUserInfoCoach($id)
    {
        $coach = $this->db->get_where('coach', array('id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $coach->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }
    public function getUserInfoCoachee($id)
    {
        $coach = $this->db->get_where('coachee', array('id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $coach->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }
    public function getInfoCoach($email)
    {
        $coach = $this->db->get_where('coach', array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $coach->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $email . ')');
            return false;
        }
    }
    public function getInfoCoachee($email)
    {
        $coach = $this->db->get_where('coachee', array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $coach->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $email . ')');
            return false;
        }
    }
    public function insertToken($email)
    {
        $token = substr(sha1(rand()), 0, 30);
        $date = date('Y-m-d');

        $string = array(
            'token' => $token,
            'email' => $email,
            'created' => $date
        );
        $query = $this->db->insert_string('tokens', $string);
        $this->db->query($query);
        return $token . $email;
    }

    public function isTokenValid($token)
    {
        $tkn = substr($token, 0, 30);

        $q = $this->db->get_where('tokens', array(
            'tokens.token' => $tkn
        ), 1);

        if ($this->db->affected_rows() > 0) {
            $row = $q->row();

            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d');
            $todayTS = strtotime($today);

            if ($createdTS != $todayTS) {
                return false;
            }
            if ($user_info = $this->getInfoCoach($row->email) != null) {
                $user_info = $this->getInfoCoach($row->email);
            } else {
                $user_info = $this->getUserInfoCoachee($row->email);
            }

            return $user_info;
        } else {
            return false;
        }
    }

    public function updatePasswordCoach($cleanPost)
    {
        $this->db->where('email', $cleanPost['email']);
        $this->db->update('coach', array('password' => $cleanPost['password']));
        return true;
    }
    public function updatePasswordCoachee($cleanPost)
    {
        $this->db->where('email', $cleanPost['email']);
        $this->db->update('coachee', array('password' => $cleanPost['password']));
        return true;
    }
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
