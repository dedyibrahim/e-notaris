<?php 
class M_dashboard extends CI_model{

public function simpan_user($data){
$query = $this->db->insert('user',$data);   
return $query;    
}
public function data_user(){
$query = $this->db->get('user');   
return $query;    
}
public function ambil_user($id_user){
$query = $this->db->get_where('user',array('id_user'=>$id_user));
return $query;

}
public function data_client_where($no_client){
$query = $this->db->get_where('data_client',array('no_client'=> base64_decode($no_client)));
return $query;
}

function json_data_berkas_client($no_client){
    
$this->datatables->select('id_data_berkas,'
.'data_berkas.no_client as no_client,'
.'data_berkas.nama_file as nama_file,'
.'data_berkas.status_berkas as status_berkas,'
.'data_berkas.pengupload as pengupload,'
);
$this->datatables->from('data_berkas');
$this->datatables->where('no_client', base64_decode($no_client));
$this->datatables->where('pengupload !=',NULL );
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=download_berkas('$1'); > Download lampiran <i class='fa fa-download'></i></button>",'id_data_berkas');
return $this->datatables->generate();
}

function json_data_riwayat(){
    
$this->datatables->select('id_data_histori_pekerjaan,'
.'data_histori_pekerjaan.keterangan as keterangan,'
.'data_histori_pekerjaan.tanggal as tanggal,'
);
$this->datatables->from('data_histori_pekerjaan');
return $this->datatables->generate();
}

public function update_user($data,$id_user){
$this->db->update('user',$data,array('id_user'=>$id_user));                                                                                                                                                                                                                                                                                                                                                                             }

public function data_nama_dokumen(){
$query = $this->db->get('nama_dokumen');
return $query;        
}
public function simpan_nama_dokumen($data){
$this->db->insert('nama_dokumen',$data);    
}
public function data_jenis(){
$query = $this->db->get('data_jenis_dokumen');
return $query;            
}

public function simpan_jenis($data){
$this->db->insert('data_jenis_dokumen',$data);    
}
public function getJenis($id_jenis){
$query = $this->db->get_where('data_jenis_dokumen',array('id_jenis_dokumen'=>$id_jenis));
return $query;
    
}

public function getSyarat($no_jenis){
$query = $this->db->get_where('data_syarat_jenis_dokumen',array('no_jenis_dokumen'=>$no_jenis));
return $query;
    
}

public function cari_nama_dokumen($term){
$this->db->from("nama_dokumen");
$this->db->limit(15);
$array = array('nama_dokumen' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}
public function cari_data_perorangan($term){
$this->db->from("data_perorangan");
$this->db->limit(15);
$array = array('nama_identitas' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}
public function cari_jenis_dokumen($term){
$this->db->from("data_jenis_dokumen");
$this->db->limit(15);
$array = array('nama_jenis' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}
public function cari_nama_klien($term){
$this->db->from("data_client");
$this->db->limit(15);
$array = array('nama_client' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}

public function cari_user($term){
$this->db->from("user");
$this->db->limit(15);
$array = array('nama_lengkap' => $term ,'level' =>"User");
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}

public function simpan_syarat($data){
$this->db->insert('data_syarat_jenis_dokumen',$data);    
}

function json_data_jenis_dokumen(){
$this->datatables->select('id_jenis_dokumen,'
. 'data_jenis_dokumen.id_jenis_dokumen as id_jenis_dokumen,'
. 'data_jenis_dokumen.no_jenis_dokumen as no_jenis_dokumen,'
. 'data_jenis_dokumen.pekerjaan as pekerjaan,'
. 'data_jenis_dokumen.nama_jenis as nama_jenis,'
);

$this->datatables->from('data_jenis_dokumen');
$this->datatables->add_column('view',""
        . "<select onchange=opsi_jenis_pekerjaan('$1','$2') class='form-control text-center opsi_pekerjaan$1'>"
        . "<option>-- Klik untuk melihat menu --</option>"
        . "<option value='1'>Tambah Persyaratan</option>"
        . "<option value='2'>Lihat persyaratan</option>"
        . "<option value='3'>Edit Pekerjaan</option>"
        . "</select>"
        . "",'id_jenis_dokumen , no_jenis_dokumen');
return $this->datatables->generate();
}
function json_data_jenis(){
$this->datatables->select('id_jenis_dokumen,'
. 'data_jenis_dokumen.id_jenis_dokumen as id_jenis_dokumen,'
. 'data_jenis_dokumen.no_jenis_dokumen as no_jenis_dokumen,'
. 'data_jenis_dokumen.pekerjaan as pekerjaan,'
. 'data_jenis_dokumen.nama_jenis as nama_jenis,'
);

$this->datatables->from('data_jenis_dokumen');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=lihat_syarat('$2'); > Lihat syarat <i class='fa fa-eye'></i></button>",'id_jenis_dokumen , no_jenis_dokumen');
return $this->datatables->generate();
}
function json_data_user(){
$this->datatables->select('id_user,'
. 'user.id_user as id_user,'
. 'user.no_user as no_user,'
. 'user.username as username,'
. 'user.nama_lengkap as nama_lengkap,'
. 'user.email as email,'
. 'user.phone as phone,'
. 'user.level as level,'
);

$this->datatables->from('user');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success'  onclick=getUser('$1'); data-toggle='modal' data-target='#exampleModal'> Edit <i class='fa fa-plus'></i></button> <button class='btn btn-sm btn-success'  onclick=tambah_sublevel('$1','$2'); > Sublevel <i class='fa fa-plus'></i></button>",'id_user,no_user');
return $this->datatables->generate();
}
function json_data_nama_dokumen(){
$this->datatables->select('id_nama_dokumen,'
.'nama_dokumen.id_nama_dokumen as id_nama_dokumen,'
.'nama_dokumen.no_nama_dokumen as no_nama_dokumen,'
.'nama_dokumen.nama_dokumen as nama_dokumen,'
);
$this->datatables->from('nama_dokumen');
$this->datatables->add_column('view',""
        . "<select onchange=opsi_nama_dokumen('$1','$2') class='form-control opsi_nama_dokumen$1'>"
        . "<option>-- Klik untuk melihat menu --</option>"
        . "<option value='1'>Lihat Meta</option>"
        . "<option value='2'>Tambah Meta</option>"
        . "<option value='3'>Edit nama dokumen</option>"
        . "</select>"
        . "",'id_nama_dokumen,no_nama_dokumen');

return $this->datatables->generate();
}



function json_data_berkas(){
    
$this->datatables->select('id_data_berkas,'
.'data_berkas.nama_file as nama_file,'
.'data_berkas.pengupload as pengupload,'
.'data_berkas.tanggal_upload as tanggal_upload,'
.'data_client.nama_client as nama_client,'
);
$this->datatables->from('data_berkas');
$this->datatables->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->datatables->where('data_berkas.pengupload !=',NULL);
$this->datatables->add_column('view','<button onclick="download($1)" class="btn btn-sm btn-success"><span class="fa fa-download"></span></button>', 'id_data_berkas,base64_encode(no_berkas)');
return $this->datatables->generate();
}
function json_data_pekerjaan(){
    
$this->datatables->select('id_data_pekerjaan,'
.'data_pekerjaan.no_pekerjaan as no_pekerjaan,'
.'data_pekerjaan.jenis_perizinan as jenis_perizinan,'
.'data_pekerjaan.pembuat_pekerjaan as pembuat_pekerjaan,'
.'data_pekerjaan.tanggal_dibuat as tanggal_dibuat,'
.'data_client.nama_client as nama_client,'
.'data_client.no_client as no_client,'
);
$this->datatables->from('data_pekerjaan');
$this->datatables->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->datatables->where('data_pekerjaan.status_pekerjaan','Proses');
$this->datatables->add_column('view','<a href ="'.base_url('Dashboard/lihat_berkas_client/$1').'"><button class="btn btn-success btn-sm"><i class="fa fa-eye"></i>  Lihat Berkas</button></a>', 'base64_encode(no_client)');
return $this->datatables->generate();
}

function json_data_client(){
    
$this->datatables->select('id_data_client,'
.'data_client.no_client as no_client,'
.'data_client.pembuat_client as pembuat_client,'
.'data_client.jenis_client as jenis_client,'
.'data_client.nama_client as nama_client,'
);
$this->datatables->from('data_client');
$this->datatables->add_column('view',""
        . "<select onchange=opsi_client('$1','$2') class='form-control opsi_pekerjaan$1'>"
        . "<option>-- Klik untuk melihat menu --</option>"
        . "<option value='1'>Lihat berkas</option>"
        . "</select>"
        . "",'id_data_client , base64_encode(no_client)');

return $this->datatables->generate();
}

function json_data_perorangan(){
    
$this->datatables->select('id_perorangan,'
.'data_perorangan.id_perorangan as id_perorangan,'
.'data_perorangan.no_nama_perorangan as no_nama_perorangan,'
.'data_perorangan.nama_identitas as nama_identitas,'
.'data_perorangan.no_identitas as no_identitas,'
.'data_perorangan.jenis_identitas as jenis_identitas,'
.'data_perorangan.status_jabatan as status_jabatan,'
);
$this->datatables->from('data_perorangan');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=download_lampiran('$1'); > Download lampiran <i class='fa fa-download'></i></button>",'id_perorangan');
return $this->datatables->generate();
}


public function hapus_syarat_dokumen($id_syarat_dokumen){
$this->db->delete('data_syarat_jenis_dokumen',array('id_syarat_dokumen'=>$id_syarat_dokumen));    
}

public function hapus_data_syarat_perorangan($id_data_syarat_perorangan){
$this->db->delete('data_syarat_perorangan',array('id_data_syarat_perorangan'=>$id_data_syarat_perorangan));    
}

public function hitung_berkas(){
$query = $this->db->get('data_berkas');
return $query;
}

public function data_berkas($id){
$this->db->select('*');
$this->db->where('data_berkas.no_berkas', base64_decode($id));
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$query = $this->db->get();  
 
return $query;
}

public function json_data_daftar_persyaratan(){
$this->datatables->select('id_data_daftar_persyaratan,'
.'data_daftar_persyaratan.no_daftar_persyaratan as no_daftar_persyaratan,'
.'data_daftar_persyaratan.nama_persyaratan as nama_persyaratan,'
.'data_daftar_persyaratan.nama_lampiran as nama_lampiran,'
);
$this->datatables->from('data_daftar_persyaratan');
return $this->datatables->generate();

    
}


public function cari_client($no_client){
$query = $this->db->get_where('data_client',array('no_client'=>$no_client));  
 
return $query;
    
}

public function data_client(){
$query = $this->db->get('data_client');  
 
return $query;
    
}

public function  data_form_perizinan($no_berkas){
         $this->db->order_by('id_syarat_dokumen',"DESC");
$query = $this->db->get_where('data_syarat_jenis_dokumen',array('no_berkas'=> base64_decode($no_berkas)));    
    
return $query;    
}

public function  data_form_perorangan($no_berkas){
         $this->db->order_by('id_data_syarat_perorangan',"DESC");
$query = $this->db->get_where('data_syarat_perorangan',array('no_berkas'=> base64_decode($no_berkas)));    
    
return $query;    
}

public function data_perorangan(){
$query = $this->db->get('data_perorangan');    
    
return $query;    
    
}

public function simpan_data_perorangan($data){
$this->db->insert('data_perorangan',$data);    
}

public function simpan_syarat_perorangan($data){
$this->db->insert('data_syarat_perorangan',$data);    
}
public function ambil_data_syarat_perorangan($id_syarat){
 $query = $this->db->get_where('data_syarat_perorangan',array('id_data_syarat_perorangan'=>$id_syarat));
 return $query;
    
    
}
public function ambil_data_perorangan($id_perorangan){
 $query = $this->db->get_where('data_perorangan',array('id_perorangan'=>$id_perorangan));
 return $query;
    
    
}
public function data_dokumen_utama($no_berkas){
 $query = $this->db->get_where('data_dokumen_utama',array('no_berkas'=> base64_decode($no_berkas)));
 return $query;
    
}

public function data_perizinan($no_berkas){
$query = $this->db->get_where('data_perizinan',array('no_berkas'=> base64_decode($no_berkas)));

return $query;

    
}
public function data_user_where($no_user){

$query = $this->db->get_where('user',array('no_user'=>$no_user));

return $query;
}


public function cari_lampiran($input){
$this->db->select('*');
$this->db->from('data_meta_berkas');
$this->db->join('data_berkas', 'data_berkas.nama_berkas = data_meta_berkas.nama_berkas');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta_berkas.no_nama_dokumen');
$array = array('data_meta_berkas.value_meta' => $input['cari_dokumen']);
$this->db->like($array);

$query = $this->db->get();
return $query;
}
public function cari_informasi($input){
$this->db->select('*');
$this->db->from('data_informasi_pekerjaan');
$array = array('data_informasi_pekerjaan.data_informasi' => $input['cari_dokumen']);
$this->db->like($array);

$query = $this->db->get();
return $query;
}
}
?>