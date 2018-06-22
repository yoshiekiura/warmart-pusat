<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions; 
use URL;
use App\User;

class RegisterKomunitasTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */


       protected function setUp()
    {
        parent::setUp();
        /*kode untuk menset base url nya jadi localhost
          karena kalau gak localhost jadi tidak bisa jalan testing http nya
         selalu responnya 404 */
        URL::forceRootUrl('https://localhost'); 
    }


    public function testHTTPRegisterKomunitas(){
             

        $response = $this->json('POST', url('/register'),[
            'name' => 'UserKomunitasTestHttp',
            'email' => 'userkomunitastesthttp@gmail.com',
            'no_telp' => '082282107750',
            'alamat' => 'Test Alamat Http', 
            'password' => 'rahasia', 
            'password_confirmation' => 'rahasia', 
            'id_register' => '2', 

        ]);

        $response->assertStatus(302)
                 ->assertRedirect(url('kirim-kode-verifikasi?nomor=082282107750&status=0'));


        $response2 = $this->get($response->headers->get('location'))->assertSee('Silakan input nomor verifikasi yang terkirim melalui SMS ke no 082282107750');

           $this->assertDatabaseHas('users',[
	            'name' => 'UserKomunitasTestHttp',
	            'email' => 'userkomunitastesthttp@gmail.com',
	            'no_telp' => '082282107750',
	            'alamat' => 'Test Alamat Http',   
                'tipe_user' => '2'
            ]); 

    }
 
    public function testHTTPVerifikasiKomunitasSalahKodeVerifikasi(){
             

        $response = $this->json('POST', url('/register'),[
            'name' => 'UserKomunitasTestHttp',
            'email' => 'userkomunitastesthttp@gmail.com',
            'no_telp' => '082282107750',
            'alamat' => 'Test Alamat Http', 
            'password' => 'rahasia', 
            'password_confirmation' => 'rahasia', 
            'id_register' => '2', 

        ]);

        $response->assertStatus(302)
                 ->assertRedirect(url('kirim-kode-verifikasi?nomor=082282107750&status=0'));


        $response2 = $this->get($response->headers->get('location'))->assertSee('Silakan input nomor verifikasi yang terkirim melalui SMS ke no 082282107750');

           $this->assertDatabaseHas('users',[
                'name' => 'UserKomunitasTestHttp',
                'email' => 'userkomunitastesthttp@gmail.com',
                'no_telp' => '082282107750',
                'alamat' => 'Test Alamat Http',   
                'tipe_user' => '2'
            ]);   

        $response = $this->json('PUT', route('user.proses_kirim_kode_verifikasi', '082282107750'),[
            'no_telp' => '082282107750',
            'kode_verifikasi' => '9820',

        ]);

        $response->assertStatus(302)
                 ->assertRedirect(url('kirim-kode-verifikasi?nomor=082282107750&status=0'));


        $response2 = $this->get($response->headers->get('location'))->assertSee('Mohon Maaf Kode Verfikasi Yang Anda Isi Tidak Sama');
    }

    public function testHTTPVerifikasiKomunitas(){
             

        $response = $this->json('POST', url('/register'),[
            'name' => 'UserKomunitasTestHttp',
            'email' => 'userkomunitastesthttp@gmail.com',
            'no_telp' => '082282107750',
            'alamat' => 'Test Alamat Http', 
            'password' => 'rahasia', 
            'password_confirmation' => 'rahasia', 
            'id_register' => '2', 

        ]);

        $response->assertStatus(302)
                 ->assertRedirect(url('kirim-kode-verifikasi?nomor=082282107750&status=0'));


        $response2 = $this->get($response->headers->get('location'))->assertSee('Silakan input nomor verifikasi yang terkirim melalui SMS ke no 082282107750');

           $this->assertDatabaseHas('users',[
                'name' => 'UserKomunitasTestHttp',
                'email' => 'userkomunitastesthttp@gmail.com',
                'no_telp' => '082282107750',
                'alamat' => 'Test Alamat Http',   
                'tipe_user' => '2'
            ]);   
        $user = User::where('no_telp','082282107750')->first();
        $response = $this->json('PUT', route('user.proses_kirim_kode_verifikasi', '082282107750'),[
            'no_telp' => '082282107750',
            'kode_verifikasi' => $user->kode_verifikasi,

        ]);

        $response->assertStatus(302)
                 ->assertRedirect(url('home'));
 
    }
}
