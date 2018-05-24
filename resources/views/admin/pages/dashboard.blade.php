@extends('admin.pages.content')
@section('page_heading','Dashboard')
@section('content')

    <div class="col-sm-6 col-lg-3">
        <div class="card text-black bg-flat-color-5">
            <div class="card-body">
                <h3 align="center">Golovi</h3><hr>
                Ukupno golova: {{$total_goals}}
            </div>
            <div class="card-footer">
                Proba footer
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-black bg-flat-color-2">
            <div class="card-body">
                Proba tekst
            </div>
            <div class="card-footer">
                Proba footer
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-black bg-flat-color-1">
            <div class="card-body">
                Proba tekst
            </div>
            <div class="card-footer">
                Proba footer
            </div>
        </div>
    </div>

            <!-- <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Members online</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70"/>
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div> -->
            

            <!-- <div class="col-lg-3 col-md-6">
                <div class="social-box facebook">
                    <i class="fa fa-facebook"></i>
                    <ul>
                        <li>
                            <sctrong><span class="count">40</span> k</strong>
                            <span>friends</span>
                        </li>
                        <li>
                            <sctrong><span class="count">450</span></strong>
                            <span>feeds</span>
                        </li>
                    </ul>
                </div>
            </div> -->

            <!-- <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Active Projects</div>
                                <div class="stat-digit">770</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

@endsection