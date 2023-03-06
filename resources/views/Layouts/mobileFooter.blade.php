{{-- <style>
#footerMobile a {
  font-size:10px;
}
</style> --}}
<div class="col-12" id="footerMobile">
      <a  href="{{route('Home-MobileAkhbaar')}}" class="{{ (request()->is('MobileAkhbaar*')) ? 'activeFooter' : '' }}" onclick="window.speechSynthesis.cancel();">
       <i class="fa fa-home font-weight-light" id="footer-Icon" aria-hidden="true"></i>
        <span class="fw-light ">Home</span>
      </a>
      <a href="{{url('ViewNewspapers')}}" class="{{ (request()->is('ViewNewspapers')) ? 'activeFooter' : '' }}" onclick="window.speechSynthesis.cancel();">
       <i class="fa fa-plus-square" aria-hidden="true" id="footer-Icon"></i>
         <span class="fw-light">Newspaper</span>
      </a>
      <a href="{{url('Search')}}" class="{{ (request()->is('Search')) ? 'activeFooter' : '' }}" onclick="window.speechSynthesis.cancel();">
       <i class="fa fa-search" aria-hidden="true" id="footer-Icon"></i>
         <span class="fw-light">Search</span>
      </a>
      <a href="{{route('bookmark')}}" class="{{(request()->is('Bookmark')) ? 'activeFooter' : '' }}" onclick="window.speechSynthesis.cancel();">
       <i class="fa fa-bookmark" aria-hidden="true" id="footer-Icon"></i>
        <span class="fw-light">Bookmarks</span>
      </a>
      <a href="{{route('ViewSetting')}}" class="{{(request()->is('Setting*')) ? 'activeFooter' : '' }}" onclick="window.speechSynthesis.cancel();">
       <i class="fa fa-user" aria-hidden="true" id="footer-Icon"></i>
        <span class="fw-light" >Setting</span>
      </a>
      {{-- <a href="{{route('ViewSetting')}}" class="{{(request()->is('Setting*')) ? 'activeFooter' : '' }}" onclick="window.speechSynthesis.cancel();">
       <i class="fa fa-user" aria-hidden="true" id="footer-Icon"></i>
        <span class="fw-light" >Login</span>
      </a> --}}
     
</div>
