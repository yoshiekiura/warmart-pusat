<template>
	
	<div class="row" >
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href=" ">Home</a></li>
                <li><router-link :to="{name: 'indexCustomer'}">Customer</router-link></li>
                <li class="active">Edit Customer</li>
            </ul>

            <div class="card">
               <div class="card-header card-header-icon" data-background-color="purple">
                  <i class="material-icons">person_add</i>
              </div>

              <div class="card-content">
               <h4 class="card-title"> Customer </h4>
               <div>
                <form v-on:submit.prevent="saveForm()" class="form-horizontal" v-if="loading"> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Nama Customer</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Nama Customer" type="text" v-model="customer.name" name="name"  autofocus="">
                            <span v-if="errors.name" id="name_error" class="label label-danger">{{ errors.name[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="name" class="col-md-2 control-label">No. Telpon</label>
                      <div class="col-md-4">
                          <input class="form-control" required autocomplete="off" placeholder="No. Telpon" type="number" v-model="customer.no_telp" name="no_telp"  autofocus="">
                          <span v-if="errors.no_telp" id="no_telp_error" class="label label-danger">{{ errors.no_telp[0] }}</span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="kode_customer" class="col-md-2 control-label">Kode Customer</label>
                    <div class="col-md-4">
                        <input class="form-control" autocomplete="off" placeholder="Kode Customer" type="text" v-model="customer.kode_customer" name="kode_customer"  autofocus="">
                        <span v-if="errors.kode_customer" id="kode_customer_error" class="label label-danger">{{ errors.kode_customer[0] }}</span>
                    </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-md-2 control-label">Email Customer</label>
                  <div class="col-md-4">
                      <input class="form-control" required autocomplete="off" placeholder="Email" type="email" v-model="customer.email" name="email"  autofocus="">
                      <span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}</span>
                  </div>
              </div>


              <div class="form-group">
                  <label for="name" class="col-md-2 control-label">Alamat Customer</label>
                  <div class="col-md-4">
                      <input class="form-control" required autocomplete="off" placeholder="Alamat" type="text" v-model="customer.alamat" name="alamat"  autofocus="">
                      <span v-if="errors.alamat" id="alamat_error" class="label label-danger">{{ errors.alamat[0] }}</span>
                  </div>
              </div>

              <div class="form-group">
                  <label for="name" class="col-md-2 control-label">Tanggal Lahir</label>
                  <div class="col-md-4">
                      <datepicker :input-class="'form-control'" placeholder="Tanggal Lahir" v-model="customer.tgl_lahir" name="uniquename" v-bind:id="'tanggal_lahir'"></datepicker>
                  </div>
              </div>

              <div class="form-group" v-if="seen">
               <label for="komunitas" class="col-md-2 control-label ">Komunitas</label>
               <div class="col-md-4">
                   <selectize-component v-model="customer.komunitas" :settings="setKomunitas" id="komunitas"> 
                       <option v-for="data_komunitas, index in komunitas" v-bind:value="data_komunitas.id" >{{ data_komunitas.name }}</option>
                   </selectize-component>
               </div>
           </div>


           <div class="form-group">
              <div class="col-md-4 col-md-offset-2">
                  <button class="btn btn-primary" id="btnSimpanCustomer" type="submit"><i class="material-icons">send</i> Submit</button>
              </div>
          </div>
      </form>
      <vue-simple-spinner v-if="!loading"></vue-simple-spinner>
  </div>
</div>
</div>
</div>
</div>

</template>

<script>
export default {
    mounted() {
        let app = this;
        let id = app.$route.params.id;
        app.customerId = id;
        app.dataKomunitas();
        axios.get(app.url+'/' + id)
        .then(function (resp) {
            app.customer = resp.data;
            if (resp.data.setting_aplikasi.tipe_aplikasi == 0) {
                app.seen = true;
            }

        })
        .catch(function () {
            alert("Tidak Bisa Memuat Customer!")
        });
    },
    data: function () {
        return {
            loading: true,
            seen: false,
            customerId: null,
            customer: {
                name: '',
                no_telp: '',
                email: '',
                alamat: '',
                tgl_lahir: '',
                komunitas: '',
            },
            message : '',
            setKomunitas: {
                placeholder: '--PILIH KOMUNITAS--'
            }, 
            url : window.location.origin+(window.location.pathname).replace("dashboard", "customer"),
            errors: []
        }
    },
    methods: {
        saveForm() {
            var app = this;
            var newCustomer = app.customer;
            app.loading = false
            axios.patch(app.url+'/' + app.customerId, newCustomer)
            .then(function (resp) {
                app.message = 'Berhasil Mengubah customer '+ app.customer.name;
                app.alert(app.message);
                app.$router.replace('/customer/');
                app.loading = true
            })
            .catch(function (resp) {
                console.log(resp);
                app.loading = true
                app.errors = resp.response.data.errors;
                alert("Periksa Kembali Data Yang Anda Masukan");
            });
        },
        dataKomunitas() {
          var app = this;
          axios.get(app.url+'/pilih-komunitas')
          .then(function (resp) {
            app.komunitas = resp.data;
        })
          .catch(function (resp) {
            alert("Tidak Bisa Memuat Komunitas!");
        });
      },
      alert(pesan) {
          this.$swal({
              title: "Berhasil !",
              text: pesan,
              icon: "success",
              buttons: false,
              timer: 1000,
          });
      }
  }
}
</script>
</script>