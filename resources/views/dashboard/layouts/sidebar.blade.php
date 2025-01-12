 <nav id="sidebar" class="sidebar js-sidebar">
     <div class="sidebar-content js-simplebar text-left">
         <a class="sidebar-brand" href="/dashboard">
             <span class="align-middle"> 
                لوحة تحكم الهلال</span>
         </a>

         <ul class="sidebar-nav pe-0">
             <li class="sidebar-item @if (session()->get('type') == 'news') active @endif ">
                 <a class="sidebar-link" href="{{ route('dashboard.sections.index', ['type' => 'news']) }}">
                     <i class="align-middle" data-feather="file-text"></i>
                     <span class="align-middle"> @lang('helal.section-types.news.plural')</span>
                 </a>
             </li>
             <li class="sidebar-item @if (session()->get('type') == 'story') active @endif">
                 <a class="sidebar-link" href="{{ route('dashboard.sections.index', ['type' => 'story']) }}">
                     <i class="align-middle" data-feather="heart"></i>
                     <span class="align-middle"> @lang('helal.section-types.story.plural')</span>
                 </a>
             </li>

             <li class="sidebar-item @if (session()->get('type') == 'article') active @endif">
                 <a class="sidebar-link" href="{{ route('dashboard.sections.index', ['type' => 'article']) }}">
                     <i class="align-middle" data-feather="book-open"></i>
                     <span class="align-middle">@lang('helal.section-types.article.plural') </span>
                 </a>
             </li>
             
             <li class="sidebar-item @if (session()->get('type') == 'vacancy') active @endif">
                 <a class="sidebar-link" href="{{ route('dashboard.sections.index', ['type' => 'vacancy']) }}">
                     <i class="align-middle" data-feather="credit-card"></i>
                     <span class="align-middle">@lang('helal.section-types.vacancy.plural') </span>
                 </a>
             </li>
             

             @if (Route::has('dashboard.martyers.index'))
                 <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'martyers')) active @endif">
                     <a class="sidebar-link" href="{{ route('dashboard.martyers.index') }}">
                         <i class="align-middle" data-feather="flag"></i>
                         <span class="align-middle">شهداء</span>
                     </a>
                 </li>
             @endif

             @if (Route::has('dashboard.fileUploads.index'))
                 <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'fileUploads')) active @endif">
                     <a class="sidebar-link" href="{{ route('dashboard.fileUploads.index') }}">
                         <i class="align-middle" data-feather="file"></i>
                         <span class="align-middle">تحميل الملفات</span>
                     </a>
                 </li>
             @endif

             @if (auth()->user()->type == 'admin')
                 <li class="sidebar-item @if (session()->get('type') == 'campaign') active @endif">
                     <a class="sidebar-link" href="{{ route('dashboard.sections.index', ['type' => 'campaign']) }}">
                         <i class="align-middle" data-feather="navigation"></i>
                         <span class="align-middle">@lang('helal.section-types.campaign.plural')</span>
                     </a>
                 </li>

                 <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'main-page')) active @endif">
                     <a class="sidebar-link" href="{{ route('dashboard.settings.index') }}">
                         <i class="align-middle" data-feather="clipboard"></i>
                         <span class="align-middle">عناصر الصفحة الرئيسية</span>
                     </a>
                 </li>

                 @if (Route::has('dashboard.provinces.index'))
                     <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'provinces')) active @endif">
                         <a class="sidebar-link" href="{{ route('dashboard.provinces.index') }}">
                             <i class="align-middle" data-feather="grid"></i>
                             <span class="align-middle">محافظات</span>
                         </a>
                     </li>
                 @endif

                 @if (Route::has('dashboard.doings.index'))
                     <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'doings')) active @endif">
                         <a class="sidebar-link" href="{{ route('dashboard.doings.index') }}">
                             <i class="align-middle" data-feather="briefcase"></i>
                             <span class="align-middle">صناديق ماذا نفعل</span>
                         </a>
                     </li>
                 @endif

                 @if (Route::has('dashboard.keywords.index'))
                     <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'keywords')) active @endif">
                         <a class="sidebar-link" href="{{ route('dashboard.keywords.index') }}">
                             <i class="align-middle" data-feather="star"></i>
                             <span class="align-middle">الكلمات المفتاحية</span>
                         </a>
                     </li>
                 @endif

                 @if (Route::has('dashboard.menus.index'))
                     <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'menus')) active @endif">
                         <a class="sidebar-link" href="{{ route('dashboard.menus.index') }}">
                             <i class="align-middle" data-feather="arrow-down-circle"></i>
                             <span class="align-middle">القائمة العلوية</span>
                         </a>
                     </li>
                 @endif

                 @if (Route::has('dashboard.users.index'))
                     <li class="sidebar-item @if (str_contains(Route::currentRouteName(), 'users')) active @endif">
                         <a class="sidebar-link" href="{{ route('dashboard.users.index') }}">
                             <i class="align-middle" data-feather="users"></i>
                             <span class="align-middle">المستخدمين</span>
                         </a>
                     </li>
                 @endif
             @endif
         </ul>
     </div>
 </nav>

 @php
     session()->forget('type');
 @endphp
