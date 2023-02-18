<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function checkAccessCode() {
        $code = $this->request->getVar('code');;
        if (empty($code)) {
            return json_encode(['status' => false, 'message' => 'Access code required']);
        }

        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM access_codes WHERE code = '".$code."' LIMIT 1");
        if (is_bool($query)) {
            return json_encode(['status' => false, 'message' => 'No record found']);
        }
        $row = $query->getRow();
        if (isset($row)) {
            return json_encode(['status' => true, 'message' => 'Record found', 'redirect_url' => $row->redirect_url]);
        }
        $db->close();
        return json_encode(['status' => false, 'message' => 'No record found']);

    }
}
