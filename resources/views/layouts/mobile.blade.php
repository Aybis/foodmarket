<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        <!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
      
        @stack('styles')
        {{-- @livewireStyles --}}

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        
    </head>
    <body>
        <div class="flex flex-row bg-red-600">
            {{-- Sidebar  --}}
            <nav class="hidden md:block flex-grow-0 w-32 bg-red-500 text-white ">
                <div class=" flex flex-col items-center justify-between justify-items-center py-8 h-screen">
                    <div>
                        <p class="font-bold text-3xl font-mono ">PINS</p>
                    </div>
                    <div class="flex flex-col justify-around gap-6">
                        <a href="#" class="h-10 w-10 bg-white flex items-center justify-center rounded-lg shadow-lg">
                            <img src="{{ asset('assets/svg/home.svg') }}" alt="home" class="h-6 fill-current text-red-600">
                        </a>    
                        <a href="#" class="h-10 w-10  flex items-center justify-center">
                            <img src="{{ asset('assets/svg/grid.svg') }}" alt="apps" class="h-6">
                        </a>  
                        <a href="#" class="h-10 w-10  flex items-center justify-center">
                            <img src="{{ asset('assets/svg/users.svg') }}" alt="users" class="h-6">
                        </a>  
                        <a href="#" class="h-10 w-10  flex items-center justify-center">
                            <img src="{{ asset('assets/svg/user.svg') }}" alt="user" class="h-6">
                        </a>  
                    </div>
                    <div>
                        <p class="font-bold">Apps &copy; 2021</p>
                    </div>
                </div>
            </nav>

            {{-- Sidebar Mobile  --}}

            <nav class="block md:hidden fixed bottom-0 w-full bg-red-500 h-20 z-50">
                <div class="flex flex-row items-center justify-between h-full px-12">
                    <a href="#" class="flex flex-col items-center gap-1">
                        <div class="flex items-center justify-center bg-white rounded-lg shadow-lg h-8 w-8">
                            <img src="{{ asset('assets/svg/home.svg') }}" alt="home" class="h-6">
                        </div>
                        <p class="text-center text-white font-semibolds text-xs">Home</p>
                    </a>    
                    <a href="#" class="flex flex-col items-center gap-1 opacity-60">
                        <div class="flex items-center justify-center h-8 w-8">
                            <img src="{{ asset('assets/svg/grid.svg') }}" alt="home" class="h-6 ">
                        </div>
                        <p class="text-center text-white font-semibolds text-xs">Apps</p>
                    </a>   
                    <a href="#" class="flex flex-col items-center gap-1 opacity-60">
                        <div class="flex items-center justify-center h-8 w-8">
                            <img src="{{ asset('assets/svg/users.svg') }}" alt="home" class="h-6 ">
                        </div>
                        <p class="text-center text-white font-semibolds text-xs">Inforekan</p>
                    </a>   
                    <a href="#" class="flex flex-col items-center gap-1 opacity-60">
                        <div class="flex items-center justify-center h-8 w-8">
                            <img src="{{ asset('assets/svg/user.svg') }}" alt="home" class="h-6 ">
                        </div>
                        <p class="text-center text-white font-semibolds text-xs">Me</p>
                    </a>   
                  
                </div>
            </nav>


            {{-- Main  --}}
            <main class="flex-grow flex-auto bg-indigo-50 shadow-2xl md:rounded-l-2xl overflow-auto h-screen">
               
                <header class="hidden md:block border-b-2 border-gray-200">
                    <div class="flex flex-row justify-between items-center max-w-7xl  py-6 sm:px-6 lg:px-8">
                        @if (Route::current()->getName() !== 'dashboard')                            
                        <button onclick="window.history.back();" class="md:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        @endif
                        {{ $header }}
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" class="inline rounded-full h-12 w-12 md:hidden" alt="image">
                    </div>
                </header>

                {{-- header mobile --}}

                <header class="flex">
                    <div class="flex flex-row items-center justify-between w-full px-8 pt-6 md:hidden">
                        <p class="text-lg font-bold font-mono">PINS</p>
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" class="inline rounded-full h-10 w-10 md:hidden" alt="image">
                        
                    </div>

                </header>

                <div class="mt-8 container mx-auto p-4 mb-24">
                    <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="flex bg-white rounded-lg h-32 items-center justify-start px-8 gap-8">
                            <div class="bg-purple-600 bg-opacity-100 shadow-md rounded h-20 w-20">

                            </div>
                            <div class="text-left items-end justify-start">
                                <p class="text-2xl md:text-3xl font-bold ">2126</p>
                                <p class="font-bold text-gray-400 opacity-75">Total Projects</p>
                            </div>
                        </div>

                        <div class="flex bg-white rounded-lg h-32 items-center justify-start px-8 gap-8">
                            <div class="bg-green-500 shadow-md rounded h-20 w-20">

                            </div>
                            <div class="text-left items-end justify-start">
                                <p class="text-2xl md:text-3xl font-bold ">1500</p>
                                <p class="font-bold text-gray-400 opacity-75">Completed</p>
                            </div>
                        </div>

                        <div class="flex bg-white rounded-lg h-32 items-center justify-start px-8 gap-8">
                            <div class="bg-yellow-400 bg-opacity-100 shadow-md rounded h-20 w-20">

                            </div>
                            <div class="text-left items-end justify-start">
                                <p class="text-2xl md:text-3xl font-bold ">650</p>
                                <p class="font-bold text-gray-400 opacity-75">In Progress</p>
                            </div>
                        </div>
                        
                    </div>

                    <div class="grid gap-4 mt-8 xl:grid-cols-3">
                        <div class="flex bg-white rounded-lg gap-8 max-w-full items-center flex-col p-4 sm:col-span-2">
                            <p class="text-center font-bold">Status Project</p>
                            <div id="bar" class="w-full h-72"></div>
                        </div>
                        <div class="flex bg-white rounded-lg gap-8 max-w-full items-center flex-col p-4">
                            <p class="text-center font-bold">Status Project</p>
                            <div id="dounat" class="w-full h-80"></div>
                        </div>

                        <div class="flex bg-white rounded-lg gap-8 max-w-full items-center flex-col p-4 sm:col-span-3">
                            <p class="text-center font-bold">SAHAM</p>
                            <div id="realtime" class="w-full h-80"></div>
                        </div>
                     
                    </div>
                </div>

            </main>




            {{-- User --}}
            <div class="hidden flex-grow-0 w-64 bg-white shadow-2xl  xl:block z-30">Me</div>
        </div>

    

<!-- Chart code -->

<script>
        
    am4core.ready(function() {
    
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    
    
    var chart = am4core.create('bar', am4charts.XYChart)
    chart.colors.step = 2;
    
    chart.legend = new am4charts.Legend()
    chart.legend.position = 'top'
    chart.legend.paddingBottom = 20
    chart.legend.labels.template.maxWidth = 95
    
    var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
    xAxis.dataFields.category = 'category'
    xAxis.renderer.cellStartLocation = 0.1
    xAxis.renderer.cellEndLocation = 0.9
    xAxis.renderer.grid.template.location = 0;
    
    var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
    yAxis.min = 0;
    
    function createSeries(value, name) {
        var series = chart.series.push(new am4charts.ColumnSeries())
        series.dataFields.valueY = value
        series.dataFields.categoryX = 'category'
        series.name = name
    
        series.events.on("hidden", arrangeColumns);
        series.events.on("shown", arrangeColumns);
    
        var bullet = series.bullets.push(new am4charts.LabelBullet())
        bullet.interactionsEnabled = false
        bullet.dy = 30;
        bullet.label.text = '{valueY}'
        bullet.label.fill = am4core.color('#ffffff')
    
        return series;
    }
    
    chart.data = [
        {
            category: 'January',
            first: 40,
            second: 55,
            third: 60
        },
        {
            category: 'February',
            first: 30,
            second: 78,
            third: 69
        },
        {
            category: 'March',
            first: 27,
            second: 40,
            third: 45
        },
        {
            category: 'April',
            first: 50,
            second: 33,
            third: 22
        }
    ]
    
    
    createSeries('first', 'Complete');
    createSeries('second', 'In Progress');
    createSeries('third', 'Done');
    
    function arrangeColumns() {
    
        var series = chart.series.getIndex(0);
    
        var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
        if (series.dataItems.length > 1) {
            var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
            var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
            var delta = ((x1 - x0) / chart.series.length) * w;
            if (am4core.isNumber(delta)) {
                var middle = chart.series.length / 2;
    
                var newIndex = 0;
                chart.series.each(function(series) {
                    if (!series.isHidden && !series.isHiding) {
                        series.dummyData = newIndex;
                        newIndex++;
                    }
                    else {
                        series.dummyData = chart.series.indexOf(series);
                    }
                })
                var visibleCount = newIndex;
                var newMiddle = visibleCount / 2;
    
                chart.series.each(function(series) {
                    var trueIndex = chart.series.indexOf(series);
                    var newIndex = series.dummyData;
    
                    var dx = (newIndex - trueIndex + middle - newMiddle) * delta
    
                    series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                    series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                })
            }
        }
    }
    
    }); // end am4core.ready()
    </script>
<!-- Chart code -->
<script>
    am4core.ready(function() {
    
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    var chart = am4core.create("realtime", am4charts.XYChart);
    
    chart.data = [{
     "country": "USA",
     "visits": 2025
    }, {
     "country": "China",
     "visits": 1882
    }, {
     "country": "Japan",
     "visits": 1809
    }, {
     "country": "Germany",
     "visits": 1322
    }, {
     "country": "UK",
     "visits": 1122
    }, {
     "country": "France",
     "visits": 1114
    }, {
     "country": "India",
     "visits": 984
    }, {
     "country": "Spain",
     "visits": 711
    }, {
     "country": "Netherlands",
     "visits": 665
    }, {
     "country": "Russia",
     "visits": 580
    }, {
     "country": "South Korea",
     "visits": 443
    }, {
     "country": "Canada",
     "visits": 441
    }];
    
    chart.padding(40, 40, 40, 40);
    
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.minGridDistance = 60;
    categoryAxis.renderer.inversed = true;
    categoryAxis.renderer.grid.template.disabled = true;
    
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.extraMax = 0.1;
    //valueAxis.rangeChangeEasing = am4core.ease.linear;
    //valueAxis.rangeChangeDuration = 1500;
    
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.categoryX = "country";
    series.dataFields.valueY = "visits";
    series.tooltipText = "{valueY.value}"
    series.columns.template.strokeOpacity = 0;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.cornerRadiusTopLeft = 10;
    //series.interpolationDuration = 1500;
    //series.interpolationEasing = am4core.ease.linear;
    var labelBullet = series.bullets.push(new am4charts.LabelBullet());
    labelBullet.label.verticalCenter = "bottom";
    labelBullet.label.dy = -10;
    labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";
    
    chart.zoomOutButton.disabled = true;
    
    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
    series.columns.template.adapter.add("fill", function (fill, target) {
     return chart.colors.getIndex(target.dataItem.index);
    });
    
    setInterval(function () {
     am4core.array.each(chart.data, function (item) {
       item.visits += Math.round(Math.random() * 200 - 100);
       item.visits = Math.abs(item.visits);
     })
     chart.invalidateRawData();
    }, 2000)
    
    categoryAxis.sortBySeries = series;
    
    }); // end am4core.ready()
    </script>



<!-- Chart code -->
<script>
    am4core.ready(function() {
    
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    // Create chart instance
    var chart = am4core.create("dounat", am4charts.PieChart);
    
    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "project";
    pieSeries.dataFields.category = "status";
    
    // Let's cut a hole in our Pie chart the size of 30% the radius
    chart.innerRadius = am4core.percent(60);
    
    // Put a thick white border around each Slice
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;
    pieSeries.slices.template
      // change the cursor on hover to make it apparent the object can be interacted with
      .cursorOverStyle = [
        {
          "property": "cursor",
          "value": "pointer"
        }
      ];
    
    pieSeries.alignLabels = false;
    pieSeries.labels.template.bent = true;
    pieSeries.labels.template.radius = 3;
    pieSeries.labels.template.padding(0,0,0,0);
    
    pieSeries.ticks.template.disabled = false;
    
    // Create a base filter effect (as if it's not there) for the hover to return to
    var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
    shadow.opacity = 0;
    
    // Create hover state
    var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
    
    // Slightly shift the shadow and make it more prominent on hover
    var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
    hoverShadow.opacity = 0.7;
    hoverShadow.blur = 5;
    
    // Add a legend
    chart.legend = new am4charts.Legend();
    
    chart.data = [{
      "status": "Complete",
      "project": 500
    },{
      "status": "In Progress",
      "project": 200
    }, {
      "status": "Done",
      "project": 200
    },];
    
    }); // end am4core.ready()
    </script>



</body>

</html>
