<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/lib/chart-js/Chart.bundle.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script src="{{asset('js/widgets.js')}}"></script>
<script src="{{asset('js/lib/vector-map/jquery.vmap.js')}}"></script>
<script src="{{asset('js/lib/vector-map/jquery.vmap.min.js')}}"></script>
<script src="{{asset('js/lib/vector-map/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('js/lib/vector-map/country/jquery.vmap.world.js')}}"></script>
<script src="{{asset('js/ajax.js')}}"></script>
@yield('script')

<script>
    ( function ( $ ) {
        "use strict";

        jQuery( '#vmap' ).vectorMap( {
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: [ '#1de9b6', '#03a9f5' ],
            normalizeFunction: 'polynomial'
        } );
    } )( jQuery );

</script>