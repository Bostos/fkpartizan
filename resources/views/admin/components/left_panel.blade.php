<!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/"><img src="{{asset('images/logo.png')}}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="/"><img src="{{asset('images/logo2.png')}}" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{route('admin')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Sportski sektor</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Igrači</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('display-all-players')}}">Pregled svih igrača</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('display-create-form')}}">Dodavanje igrača</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('display-insert-cap')}}">Dodavanje nastupa</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-calendar"></i>Utakmice</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('matches.index')}}">Pregled svih utakmica</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('matches.create')}}">Dodavanje utakmice</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-circle-o"></i>Golovi</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('goals.index')}}">Pregled svih golova</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('goals.create')}}">Dodavanje golova</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-circle-o"></i>Klubovi</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('clubs.index')}}">Pregled svih klubova</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('clubs.create')}}">Dodavanje klubova</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-random"></i>Transferi</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('transfers.index')}}">Pregled svih transfera</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('transfers.create')}}">Dodavanje transfera</a></li>
                        </ul>
                    </li>
                    
                    <h3 class="menu-title">Informativni sektor</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list-alt"></i>Vesti</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('news.index')}}">Pregled svih vesti</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('news.create')}}">Dodavanje vesti</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-picture-o"></i>Slike</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('photos.index')}}">Pregled svih slika</a></li>
                            <li><i class="fa fa-upload"></i><a href="{{route('photos.create')}}">Dodavanje slika</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Statistika</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tabele</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('tables.index')}}">Pregled svih tabela</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('tables.create')}}">Dodavanje tabela</a></li>
                            <li><i class="fa fa-list"></i><a href="{{route('seasons.index')}}">Pregled svih sezona</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('seasons.create')}}">Dodavanje nove sezone</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list-ol"></i>Liste strelaca</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="ui-buttons.html">Pregled svih lista strelaca</a></li>
                            <li><i class="fa fa-plus"></i><a href="ui-buttons.html">Pravljenje nove liste</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Upravljanje sajtom</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Upravljanje korisnicima</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="">Pregled svih korisnika</a></li>
                            <li><i class="fa fa-list"></i><a href="{{route('roles.index')}}">Pregled svih uloga</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('roles.create')}}">Dodavanje uloge</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Navigacija</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('menus.index')}}">Pregled svih menija</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('menus.create')}}">Dodavanje menija</a></li>
                        </ul>
                    </li>
                    

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->