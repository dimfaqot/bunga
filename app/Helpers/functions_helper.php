<?php


function db($tabel, $db = null)
{
    if ($db == null || $db == 'toko-bunga') {
        $db = \Config\Database::connect();
    } else {
        $db = \Config\Database::connect(strtolower(str_replace(" ", "_", $db)));
    }
    $db = $db->table($tabel);

    return $db;
}

function get_cols($tabel, $db = null)
{

    if ($db == null || $db == 'toko-bunga') {
        $db = \Config\Database::connect();
    } else {
        $db = \Config\Database::connect(strtolower(str_replace(" ", "_", $db)));
    }
    return $db->getFieldNames($tabel);
}

function menus()
{
    $q1[] = ['id' => 0, 'urutan' => 0, 'role' => (session('role') ? session('role') : 'Public'), 'menu' => 'Home', 'tabel' => 'users', 'controller' => (session('role') ? 'home' : ''), 'icon' => "fa-solid fa-earth-asia", 'url' => 'home', 'logo' => 'file_not_found.jpg', 'grup' => 'home'];
    $db = db('menu');
    $q2 = $db->where('role', (session('role') ? session('role') : 'Public'))->orderBy('urutan', 'ASC')->get()->getResultArray();
    $menus = array_merge($q1, $q2);

    return $menus;
}


function menu($req = null)
{
    $res = [];
    if ($req == null) {

        foreach (menus() as $i) {
            if ($i['controller'] == url()) {
                $res = $i;
            }
        }
    } else {
        foreach (menus() as $i) {
            if ($i['controller'] == $req) {
                $res = $i;
            }
        }
    }

    return $res;
}

function url($req = null)
{

    $url = service('uri');
    $res = $url->getPath();
    $val = '';
    if ($req == null) {
        if (getenv('is_online') == 0) {
            $req = 2;
        } else {
            $req = 3;
        }
    } else {
        if (getenv('is_online') == 0) {
            $req = $req - 1;
        }
    }


    $exp = explode("/", $res);

    if (array_key_exists($req, $exp)) {
        $val = $exp[$req];
    }
    return $val;
}

function check_role($order = null)
{

    if (!session('id')) {
        gagal(base_url(), 'You are not login. Login first!.');
    }

    if ($order == null) {
        if (!menu()) {
            gagal(base_url('home'), 'You are not allowed!.');
        }
    }
}


function angka($uang)
{
    return number_format($uang, 0, ",", ".");
}

function sukses($url, $pesan)
{
    session()->setFlashdata('sukses', $pesan);
    header("Location: " . $url);
    die;
}

function gagal($url, $pesan)
{
    session()->setFlashdata('gagal', $pesan);
    header("Location: " . $url);
    die;
}

function sukses_js($pesan, $data = null, $data2 = null, $data3 = null, $data4 = null)
{
    $data = [
        'status' => '200',
        'message' => $pesan,
        'data' => $data,
        'data2' => $data2,
        'data3' => $data3,
        'data4' => $data4
    ];

    echo json_encode($data);
    die;
}

function gagal_js($pesan, $data = null, $data2 = null, $data3 = null, $data4 = null)
{
    $res = [
        'status' => '400',
        'message' =>  $pesan,
        'data' => $data,
        'data2' => $data2,
        'data3' => $data3,
        'data4' => $data4
    ];

    echo json_encode($res);
    die;
}

function clear($text)
{
    $text = trim($text);
    $text = htmlspecialchars($text);
    return $text;
}


function upper_first($text)
{
    $exp = explode(" ", $text);

    $val = [];
    foreach ($exp as $i) {
        $lower = strtolower($i);
        $val[] = ucfirst($lower);
    }

    return implode(" ", $val);
}


function rp_to_int($uang)
{
    $uang = str_replace("Rp. ", "", $uang);
    $uang = str_replace(".", "", $uang);
    return $uang;
}

function rupiah($uang)
{
    return 'Rp. ' . number_format($uang, 0, ",", ".");
}


function hari($req = null)
{
    $hari = [
        ['inggris' => 'Monday', 'indo' => 'Senin', 'singkatan' => 'Sn'],
        ['inggris' => 'Tuesday', 'indo' => 'Selasa', 'singkatan' => 'Sl'],
        ['inggris' => 'Wednesday', 'indo' => 'Rabu', 'singkatan' => 'Rb'],
        ['inggris' => 'Thursday', 'indo' => 'Kamis', 'singkatan' => 'Km'],
        ['inggris' => 'Friday', 'indo' => 'Jumat', 'singkatan' => 'Jm'],
        ['inggris' => 'Saturday', 'indo' => 'Sabtu', 'singkatan' => 'Sb'],
        ['inggris' => 'Sunday', 'indo' => 'Ahad', 'singkatan' => 'Mg']
    ];

    if ($req == null) {
        return $hari;
    }
    $res = [];
    foreach ($hari as $i) {
        if ($i['inggris'] == $req) {
            $res = $i;
        } elseif ($i['indo'] == $req) {
            $res = $i;
        }
    }

    return $res;
}

function bulan($req = null)
{
    $bulan = [
        ['romawi' => 'I', 'bulan' => 'Januari', 'angka' => '01', 'satuan' => 1],
        ['romawi' => 'II', 'bulan' => 'Februari', 'angka' => '02', 'satuan' => 2],
        ['romawi' => 'III', 'bulan' => 'Maret', 'angka' => '03', 'satuan' => 3],
        ['romawi' => 'IV', 'bulan' => 'April', 'angka' => '04', 'satuan' => 4],
        ['romawi' => 'V', 'bulan' => 'Mei', 'angka' => '05', 'satuan' => 5],
        ['romawi' => 'VI', 'bulan' => 'Juni', 'angka' => '06', 'satuan' => 6],
        ['romawi' => 'VII', 'bulan' => 'Juli', 'angka' => '07', 'satuan' => 7],
        ['romawi' => 'VIII', 'bulan' => 'Agustus', 'angka' => '08', 'satuan' => 8],
        ['romawi' => 'IX', 'bulan' => 'September', 'angka' => '09', 'satuan' => 9],
        ['romawi' => 'X', 'bulan' => 'Oktober', 'angka' => '10', 'satuan' => 10],
        ['romawi' => 'XI', 'bulan' => 'November', 'angka' => '11', 'satuan' => 11],
        ['romawi' => 'XII', 'bulan' => 'Desember', 'angka' => '12', 'satuan' => 12]
    ];

    $res = $bulan;
    foreach ($bulan as $i) {
        if ($i['bulan'] == $req) {
            $res = $i;
        } elseif ($i['angka'] == $req) {
            $res = $i;
        } elseif ($i['satuan'] == $req) {
            $res = $i;
        } elseif ($i['romawi'] == $req) {
            $res = $i;
        }
    }
    return $res;
}


function is_menu_active($grup)
{

    $db = db('menu');
    $res = null;
    if (session('id')) {
        $q = $db->where('controller', menu()['controller'])->where('grup', $grup)->get()->getRowArray();
        if ($q) {
            $res = 1;
        }
    } else {
        if ($grup == '' && url() == "") {
            $res = 1;
        } else {
            $q = $db->where('controller', menu()['controller'])->where('grup', $grup)->get()->getRowArray();
            if ($q) {
                $res = 1;
            }
        }
    }
    return $res;
}

function get_tahuns($tabel)
{
    $db = db($tabel);
    $q = $db->get()->getResultArray();

    $res = [];

    foreach ($q as $i) {
        if (!in_array(date('Y', $i['tgl']), $res)) {
            $res[] = date('Y', $i['tgl']);
        }
    }

    return $res;
}

function settings($req = null)
{
    $db = db('settings');
    $q = $db->get()->getRowArray();

    if ($req == null) {
        return $q;
    } else {
        return $q[$req];
    }
}
function about_term($req = null)
{
    $db = db('about_term');
    $q = $db->get()->getRowArray();

    if ($req == null) {
        return $q;
    } else {
        return $q[$req];
    }
}


function urutan_transaksi()
{
    $db = db('urutan_transaksi');
    $q = $db->orderBy('urutan', 'ASC')->get()->getResultArray();

    return $q;
}

function text_wa_pemesanan($data)
{
    $text = "whatsapp://send/?phone=+62" . substr(settings('no_penerima_pesanan'), 1) . "&amp;text=" . settings('text_wa') . "%0a";
    $text .= $data['nama'] . "%0a%0a";
    $text .= base_url('p/product/') . $data['id'];

    return $text;
}

function products($order = null)
{
    $db = db('products');

    $data = [];
    $db;
    if ($order == null) {
        $data = $db->orderBy('nama', 'ASC')->get()->getResultArray();
    } elseif ($order == 'unggulan') {
        $data = $db->orderBy('visited', 'DESC')->limit('5')->get()->getResultArray();
    } else {
        $exp = explode(" ", $order);
        $data = $db->orderBy($exp[0], $exp[1])->get()->getResultArray();
    }

    return $data;
}


function count_menu_grup($grup)
{
    $db = db('menu');
    return $db->where('role', session('role') ? session('role') : 'Public')->where('grup', $grup)->countAllResults();
}

function options($kategori = null)
{
    $db = db('options');

    $db;
    if ($kategori !== null) {
        $db->where('kategori', $kategori);
    }
    if ($kategori == 'Role') {
        if (session('role') == 'Admin') {
            $db->whereNotIn('value', ['Root']);
        }
        if (session('role') == 'Staff') {
            $db->whereNotIn('value', ['Root', 'Admin']);
        }
    }
    $q = $db->orderBy('id', 'ASC')->get()->getResultArray();

    return $q;
}
