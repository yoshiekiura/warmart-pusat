  <li>
        <a data-toggle="collapse" href="#transaksiKas">
            <i class="material-icons">
                autorenew
            </i>
            <p>
                Kas
                <b class="caret">
                </b>
            </p>
        </a>
        <div class="collapse" id="transaksiKas">
            <ul class="nav">
                <li>
                    <router-link :to="{name: 'indexKas'}" class="menu-nav">
                        <span class="sidebar-mini">
                            K
                        </span>
                        <span class="sidebar-normal">
                            Kas
                        </span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'indexKategoriTransaksi'}" class="menu-nav">
                        <span class="sidebar-mini">
                            KT
                        </span>
                        <span class="sidebar-normal">
                            Kategori Transaksi
                        </span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'indexKasMasuk'}" class="menu-nav">
                        <span class="sidebar-mini">
                            KM
                        </span>
                        <span class="sidebar-normal">
                            Kas Masuk
                        </span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'indexKasKeluar'}" class="menu-nav">
                        <span class="sidebar-mini">
                            KK
                        </span>
                        <span class="sidebar-normal">
                            Kas Keluar
                        </span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'indexKasMutasi'}" class="menu-nav">
                        <span class="sidebar-mini">
                            KMT
                        </span>
                        <span class="sidebar-normal">
                            Kas Mutasi
                        </span>
                    </router-link>
                </li>
            </ul>
        </div>
    </li>

    <!--PRODUK -->
    <li>
        <router-link :to="{name: 'indexProduk'}" class="menu-nav">
            <i class="material-icons">
                store
            </i>
            <p>Produk</p>
        </router-link>
    </li>

    <li>
        <a data-toggle="collapse" href="#persediaan">
            <i class="material-icons">
                assessment
            </i>
            <p>
                Persediaan
                <b class="caret">
                </b>
            </p>
        </a>
        <div class="collapse" id="persediaan">
            <ul class="nav">
                <li>
                 <router-link :to="{name: 'indexItemMasuk'}" class="menu-nav">
                    <span class="sidebar-mini">
                        IM
                    </span>
                    <span class="sidebar-normal">
                        Item Masuk
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexItemKeluar'}" class="menu-nav">
                    <span class="sidebar-mini">
                        IK
                    </span>
                    <span class="sidebar-normal">
                        Item Keluar
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexLaporanPersediaan'}" class="menu-nav">
                    <span class="sidebar-mini">
                        LP
                    </span>
                    <span class="sidebar-normal">
                        Laporan Persediaan
                    </span>
                </router-link>
            </li>
        </ul>
    </div>
</li>

<!--PEMBELIAN-->
<li>
    <router-link :to="{name: 'indexPembelian'}" class="menu-nav">
        <i class="material-icons">
            add_shopping_cart
        </i>
        <p>
            Pembelian
        </p>
    </router-link>
</li>

<!--PESANAN -->
<li>
    <router-link :to="{name: 'indexPesananWarung'}" class="menu-nav">
        <i class="material-icons">
            archive
        </i>
        <p>
            Pesanan
        </p>
    </router-link>
</li>

{{-- PENJUALAN --}}
<li>
    <router-link :to="{name: 'createPenjualan'}" class="menu-nav">
        <i class="material-icons">
            shop
        </i>
        <p>
            Penjualan
        </p>
    </router-link>
</li>

<li>
    <a data-toggle="collapse" href="#laporan">
        <i class="material-icons">
            assignment
        </i>
        <p>
            Laporan
            <b class="caret">
            </b>
        </p>
    </a>
    <div class="collapse" id="laporan">
        <ul class="nav">
            <li>
                <router-link :to="{name: 'indexLaporanLabaKotor'}" class="menu-nav">
                    <span class="sidebar-mini">
                        LK
                    </span>
                    <span class="sidebar-normal">
                        Laba Kotor /Pelanggan
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexLaporanLabaKotorProduk'}" class="menu-nav">
                    <span class="sidebar-mini">
                        LK
                    </span>
                    <span class="sidebar-normal">
                        Laba Kotor /Produk
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexLaporanMutasiStok'}" class="menu-nav">
                    <span class="sidebar-mini">
                        LM
                    </span>
                    <span class="sidebar-normal">
                        Laporan Mutasi Stok
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexLaporanPembelianProduk'}" class="menu-nav">
                    <span class="sidebar-mini">
                        LP
                    </span>
                    <span class="sidebar-normal">
                        Laporan Pembelian /Produk
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexPenjualan'}" class="menu-nav">
                    <span class="sidebar-mini">
                        LP
                    </span>
                    <span class="sidebar-normal">
                        Laporan Penjualan
                    </span>
                </router-link>
            </li>
        </ul>
    </div>
</li>

<li>
    <a data-toggle="collapse" href="#pagesExamples">
        <i class="material-icons">
            image
        </i>
        <p>
            Master Data
            <b class="caret">
            </b>
        </p>
    </a>
    <div class="collapse" id="pagesExamples">
        <ul class="nav">
            <li>
                <router-link :to="{name: 'indexCustomer'}" class="menu-nav">
                    <span class="sidebar-mini">
                        CU
                    </span>
                    <span class="sidebar-normal">
                        Customer
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexKelompokProduk'}" class="menu-nav">
                    <span class="sidebar-mini">
                        KP
                    </span>
                    <span class="sidebar-normal">
                        Kelompok Produk
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexSatuan'}" class="menu-nav">
                    <span class="sidebar-mini">
                        SA
                    </span>
                    <span class="sidebar-normal">
                        Satuan
                    </span>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'indexSuplier'}" class="menu-nav">
                    <span class="sidebar-mini">
                        SU
                    </span>
                    <span class="sidebar-normal">
                        Supplier
                    </span>
                </router-link>
            </li>
        </ul>
    </div>
</li>