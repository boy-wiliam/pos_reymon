<nav class="navbar navbar-expand-lg navbar-dark shadow-lg">

<style>

.navbar-modern {

    background: linear-gradient(
        135deg,
        #052e16,
        #064e3b,
        #065f46
    );

    padding: 15px 25px;

}



/* BRAND */

.navbar-brand {

    font-size:24px;
    font-weight:800;
    color:white !important;

}


.brand-icon {

    width:45px;
    height:45px;

    display:inline-flex;
    align-items:center;
    justify-content:center;

    background:#10b981;

    border-radius:15px;

    margin-right:10px;

    font-size:24px;

}





/* MENU */


.nav-link {

    color:#d1fae5 !important;

    font-weight:600;

    margin:0 5px;

    padding:10px 15px !important;

    border-radius:12px;

    transition:.3s;

}



.nav-link:hover {

    background:rgba(255,255,255,.15);

    color:white !important;

    transform:translateY(-2px);

}




.nav-link.active {

    background:#10b981;

    color:white !important;

    box-shadow:
    0 5px 15px rgba(16,185,129,.4);

}




/* LOGOUT */


.logout-btn {

    border:none;

    padding:10px 22px;

    border-radius:15px;

    background:#dc2626;

    color:white;

    font-weight:700;

    transition:.3s;

}



.logout-btn:hover {

    background:#991b1b;

    transform:translateY(-3px);

    box-shadow:
    0 8px 20px rgba(220,38,38,.4);

}




/* MOBILE */


.navbar-toggler {

    border:none;

}


.navbar-toggler:focus {

    box-shadow:none;

}



</style>




<div class="container-fluid navbar-modern">



<a class="navbar-brand d-flex align-items-center" href="#">

    <span class="brand-icon">
        🛒
    </span>

    Aplikasi POS

</a>





<button 
class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarSupportedContent"
aria-controls="navbarSupportedContent"
aria-expanded="false">

<span class="navbar-toggler-icon"></span>

</button>






<div class="collapse navbar-collapse" id="navbarSupportedContent">



<ul class="navbar-nav me-auto mb-2 mb-lg-0">



<li class="nav-item">

<a 
class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
href="{{ route('dashboard') }}">

Dashboard

</a>

</li>





<li class="nav-item">

<a 
class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}"
href="{{ route('admin.users') }}">

Users

</a>

</li>





<li class="nav-item">

<a 
class="nav-link {{ Request::is('produk') ? 'active' : '' }}"
href="{{ route('produk.index') }}">

Produk

</a>

</li>





<li class="nav-item">

<a 
class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}"
href="{{ route('penjualan.index') }}">

Penjualan

</a>

</li>





</ul>







<form action="{{ route('logout') }}" method="POST">

@csrf


<button type="submit" class="logout-btn">

Logout

</button>


</form>





</div>



</div>


</nav>