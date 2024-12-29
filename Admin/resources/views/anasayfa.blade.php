@extends('layouts.master')
@section('title','Dashboard')

@section('header')
<link rel="stylesheet" type="text/css" href="./assets/css/jquery.qtip.min.css">
@endsection

@section('content')

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Satış Analizleri</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="body">
                            <div class="w_summary">
                                <div class="s_chart">
                                    <span class="chart">5,2,3,6,9,8,4,1,2,8</span>
                                </div>
                                <div class="s_detail">
                                    <h2 class="font700 mb-0">{{number_format($bugun, 0, ",", ".")}} ₺</h2>
                                    <span><i class="fa fa-level-up text-success"></i> Bugünki Satış</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="body">
                            <div class="w_summary">
                                <div class="s_chart">
                                    <span class="chart">6,3,2,5,8,9,5,4,2,3</span>
                                </div>
                                <div class="s_detail">
                                    <h2 class="font700 mb-0">{{number_format($hafta, 0, ",", ".")}} ₺</h2>
                                    <span><i class="fa fa-level-up text-success"></i> 1 Haftalık Satış</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="body">
                            <div class="w_summary">
                                <div class="s_chart">
                                    <span class="chart">3,5,1,6,2,4,8,5,3,2</span>
                                </div>
                                <div class="s_detail">
                                    <h2 class="font700 mb-0">{{number_format($ay, 0, ",", ".")}} ₺</h2>
                                    <span><i class="fa fa-level-up text-success"></i> 1 Aylık Satış</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="body">
                            <div class="w_summary">
                                <div class="s_chart">
                                    <span class="chart">8,5,2,9,6,3,4,5,6,7</span>
                                </div>
                                <div class="s_detail">
                                    <h2 class="font700 mb-0">{{number_format($tahmin, 0, ",", ".")}} ₺</h2>
                                    <span><i class="fa fa-level-up text-success"></i> Tahmini Satış</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h2>Haftanın Günlerine Göre Satışlar</h2>
                                </div>
                                <div class="body text-center">
                                    <h4 class="d-none">Haftalık Satış Raporu</h4>
                                    <div id="Page_Views" style="height: 140px"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="header">
                                    <h2>Saatlere Göre Satışlar</h2>
                                </div>
                                <div class="body text-center">
                                    <h4 class="d-none">Haftalık Satış Raporu</h4>
                                    <div id="Page_Views2" style="height: 140px"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="body">
                                    <div class="card-value float-right text-muted"><i class="icon-envelope"></i></div>
                                    <h3 class="mb-1">{{$mailSayisi}}</h3>
                                    <div>Toplam Mail</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="body top_counter">
                                    <div class="icon bg-success text-white"><i class="fas fa-shopping-cart"></i> </div>
                                    <div class="content">
                                        <span>Ürün Sayısı</span>
                                        <h5 class="number mb-0">{{$urunSayisi}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h2>Satış İstatistiği</h2>
                                </div>
                                <div class="body text-center">
                                    <div id="Order_status" style="height: 268px"></div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-6">
                                            <h6 class="mb-0">{{number_format($gecenAy, 0, ",", ".")}} ₺</h6>
                                            <small class="text-muted">Geçen Ay</small>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-0">{{number_format($ay, 0, ",", ".")}} ₺</h6>
                                            <small class="text-muted">Bu Ay</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="body">
                                    <div class="card-value float-right text-muted"><i class="icon-bubbles"></i></div>
                                    <h3 class="mb-1">{{number_format($yorumSayisi, 0, ",", ".")}}</h3>
                                    <div>Toplam Yorum</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="body top_counter">
                                    <div class="icon bg-warning text-white"><i class="fas fa-shopping-basket"></i> </div>
                                    <div class="content">
                                        <span>Yeni Sipariş Sayısı</span>
                                        <h5 class="number mb-0">{{$yeniSiparisSayisi}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">
                                    <div class="card-value float-right text-blue"></div>
                                    <h4 class="mb-1 custom-text">{{number_format($kesinlesmis, 0, ",", ".")}} ₺</h4>
                                    <div>Kesinleşmiş Satışlar</div>
                                </div>
                                <div class="card-chart-bg d-none">
                                    <span id="linecustom">6,7,5,9,7,8,4,7,6,9,11,16,10,8,9,12</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card user_statistics">
                        <div class="header">
                            <h2>Ürün / Satış Grafiği</h2>
                        </div>
                        <div class="body">
                            <div id="chart-Short-Term-Assets" style="height: 350px"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>Cihazlara Göre Satışlar</h2>
                        </div>
                        <div class="body">
                            <div id="chart-Events-Interest" style="height: 300px"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="header"><h2>Şehirlere Göre Sipariş İstatistiği</h2></div>
                        <div class="row">
                            <div class="col-9 d-xl-block d-none">
                                <div class="body">
                                    <div id="map"></div>  
                                    <h6 class="mb-1 text-center" style="color:#15d4f5;visibility:hidden;font-weight:500;" id="cityCount">İstanbul : 524</h6>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="body" style="padding-bottom:8px;height:100%;">
                                    <table class="cityTable table">
                                        <tbody>
                                            @foreach($topSehirler as $key=>$city)
                                            <tr>
                                                <td><h6><span class="numberCity">{{$key+1}})</span> {{$city->sehir}}</h6><p>{{$city->count}}</p></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Son Gelen 5 Sipariş</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom spacing5 mb-0">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>İsim</th>
                                        <th>Soyisim</th>
                                        <th>Telefon</th>
                                        <th>Şehir/İlçe</th>
                                        <th>Fiyat</th>
                                        <th>Durum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($siparisler as $index=>$siparis)
                                    <tr>
                                        <td>#{{$index+1}}</td>
                                        <td><a href="{{route('siparisDetay',$siparis->id)}}" style="color:#77797c;"><i class="fas fa-edit"></i> {{$siparis->ad}}</a></td>
                                        <td>{{$siparis->soyad}}</td>
                                        <td>{{$siparis->tel}}</td>
                                        <td>{{$siparis->sehir}} / {{$siparis->ilce}}</td>
                                        <td>{{$siparis->fiyat}} ₺</td>
                                        <td><span class="badge badge-success">Yeni Sipariş</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $("#home").addClass('active');
    </script>
    <script src="/assets/js/index5.js"></script>
    <script src="/assets/js/index6.js"></script>
    <script>
        /*Satış İstatistiği*/
        var chart = c3.generate({
            bindto: '#Order_status', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    @if(($ay+$gecenAy) == 0)
                    ['data1', {{100*$ay/(1)}}],
                    ['data2', {{100*$gecenAy/(1)}}]
                    @else
                    ['data1', {{100*$ay/($ay+$gecenAy)}}],
                    ['data2', {{100*$gecenAy/($ay+$gecenAy)}}]
                    @endif

                ],
                type: 'donut', // default type of chart
                colors: {
                    'data1': '#FFA117',
                    'data2': '#ffd861',
                },
                names: {
                    // name of each serie
                    'data1': 'Bu Ay',
                    'data2': 'Geçen Ay'
                }
            }
        });
        //$populerUrunler
        /*Ürün Satış Grafiği*/
        var chart = c3.generate({
            bindto: '#chart-Short-Term-Assets', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1',
                        @foreach($populerUrunler as $populer)
                            {{$populer->count}},
                        @endforeach
                    ],
                ],
                type: 'bar', // default type of chart
                groups: [
                    ['data1', 'data2', 'data3', 'data4', 'data5']
                ],
                colors: {
                    'data1': '#8c7ae6',
                },
                names: {
                    // name of each serie
                    'data1': 'Satış Adeti',
                }
            },
            axis: {
                x: {
                    type: 'category',
                    // name of each category
                    categories: [
                        @foreach($populerUrunler as $populer)
                        @php
                            $urun = \App\Models\Urunler::where('id',$populer->urun_id)->first();
                        @endphp
                            '{{$urun->urun_adi}}',
                        @endforeach
                    ]
                },
            }
        });


        // Haftanın Günlük Satışları
        var chart = c3.generate({
            bindto: '#Page_Views', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1', {{implode(',',$haftaninGunleri)}} ]
                ],
                type: 'bar', // default type of chart
                groups: [
                    [ 'data1',]
                ],
                colors: {
                    'data1': '#2ecc71'
                },
                names: {
                    // name of each serie
                    'data1': 'Satış',
                }
            },
            axis: {
                x: {
                    type: 'category',
                    // name of each category
                    categories: ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi','Pazar']
                },
            },
            bar: {
                width: 10
            },
            legend: {
                show: false, //hide legend
            },
            padding: {
                bottom: -20,
                top: 0,
                left: -6,
            },
        });


        // Saatlere Göre Satışlar
        var chart = c3.generate({
            bindto: '#Page_Views2', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1', {{implode(',',$saatlikSatislar)}}]
                ],
                type: 'bar', // default type of chart
                groups: [
                    [ 'data1',]
                ],
                colors: {
                    'data1': '#FC427B'
                },
                names: {
                    // name of each serie
                    'data1': 'Satış',
                }
            },
            axis: {
                x: {
                    type: 'category',
                    // name of each category
                    categories: ['00:00-02:00', '02:00-04:00', '04:00-06:00', '06:00-08:00', '08:00-10:00', '10:00-12:00','12:00-14:00','14:00-16:00','16:00-18:00','18:00-20:00','20:00-22:00','22:00-00:00']
                },
            },
            bar: {
                width: 10
            },
            legend: {
                show: false, //hide legend
            },
            padding: {
                bottom: -20,
                top: 0,
                left: -6,
            },
        });

    </script>
    <script type="text/javascript" src="./assets/js/map/raphael-min.js"></script>
    <script type="text/javascript" src="./assets/js/map/paths.js"></script>
    <script type="text/javascript" src="./assets/js/map/jquery.qtip.min.js"></script>

    <script>
        	var iscountyselected = false;
            var previouscountyselected = "blank";
            var start = true;
            var past = null;
            var content_dir = "details";
            
            $(function(){
            
            var r = Raphael('map'),
            attributes = {
                    fill: '#666',
                    stroke: '#282b2f',
                    'stroke-width':.5,
                    'stroke-linejoin': 'round',
                },
            arr = new Array();
            
            for (var county in paths) {
                
                var obj = r.path(paths[county].path);
                
                obj.attr(attributes);
                
                arr[obj.id] = county;
                    
                                    
                if(arr[obj.id] != 'blank') 
                {				
                    obj.data('selected', 'notSelected');
                    
                
                
                    obj.node.id = arr[obj.id];
                    
                    obj.attr(attributes).attr( { title: paths[arr[obj.id]].name } );
                    

                    obj
                    .hover(function(){
                        $('#coatOfArms').addClass(arr[this.id]+'large sprite-largecrests');
                        
                        $('#countyInfo').text(paths[arr[this.id]].name);
                        
                        $('#searchResults').stop(true,true);
                        
                                    
                    }, function(){	
                        $('#coatOfArms').removeClass();			
                        if(paths[arr[this.id]].value == 'notSelected')
                            {
                            $('.'+paths[arr[this.id]].name)
                                    .slideUp('slow', function() { 
                                        $(this).remove(); 
                                    });
                        }
                    });
                    $("svg a").qtip({
                    
                            content: {
                                attr: 'title'
                            },
                            show: 'mouseover',
                            hide: 'mouseout',
                            position: {
                                target: 'leave'
                            },
                            style: {
                                classes: 'ui-tooltip-tipsy ui-tooltip-shadow',
                                tip: false
                            }
                    });
                    
                    obj.click(function(){	
                    
                        if(paths[arr[this.id]].value == 'notSelected')
                        {
                                this.animate({
                                fill: '#000'
                            }, 200);
                    
                            paths[previouscountyselected].value = "notSelected";
                            paths[arr[this.id]].value = "isSelected";
                            
                            previouscountyselected = paths[arr[this.id]].name;
                            
                            $('<div/>', {
                                    title: arr[this.id],
                                    'class': arr[this.id]+'small sprite-smallcrests'
                                }).appendTo('#selectedCounties').qtip(countyCrest);
                                                        
                            $("#countymenu").val(paths[arr[this.id]].county); 
                            
                            
                                
                            if (!start && past != this)
                            {
                                past.animate({ fill: '#666'	}, 200);
                            }
                            past = this;
                            start = false;					
                        }
            
                            
                        else if(paths[arr[this.id]].value == 'isSelected')
                            {
                                this.animate({
                                    fill: '#15d4f5'
                                }, 200);
                                
                                paths[arr[this.id]].value = "notSelected"; 
                                
                                $("." + previouscountyselected+'small').remove();
                                
                                
                            }	
                        
                        });

                    var countyCrest = 	{
                            content: {
                                attr: 'title'
                            },
                            position: {
                                target: 'mouse'
                            },
                            style: {
                                classes: 'ui-tooltip-tipsy ui-tooltip-shadow',
                                tip: true
                            }
                    };
                    
                    function hoverin(e){
                        if(paths[arr[this.id]].value == 'notSelected')
                            this.animate({
                                fill: '#15d4f5'}, 50);

                        var sehir=paths[arr[this.id]].name;
                        var count=paths[arr[this.id]].order;
                        $("#cityCount").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
                        $("#cityCount").html(sehir+": "+count);					
                    }

                    function hoverout(e){			
                        if(paths[arr[this.id]].value == 'notSelected')
                            this.animate({
                                fill: '#666'}, 300);
                        $("#cityCount").css({visibility:"hidden", opacity: 1.0}).animate({opacity: 1.0},200);
                    }

                    obj.mouseout(hoverout);
                        
                    obj.mouseover(hoverin);

                    $('#countyInfo').hide();
                    
                    $('#spinner').hide();

                    var topSehirler = [
                        @foreach($topAllSehirler as $k=>$allcity)
                            '{{$allcity->sehir}}',
                        @endforeach
                    ];

                    var topSehirlerCount = [
                        @foreach($topAllSehirler as $k=>$allcity)
                            '{{$allcity->count}}',
                        @endforeach
                    ];

                    for (const [key, value] of Object.entries(paths)) {
                        for (const [key2, value2] of Object.entries(value)) {
                            if(topSehirler.includes(value.name))
                                value.order = topSehirlerCount[topSehirler.indexOf(value.name)];
                            else
                                value.order = "0";
                        }
                    }
                        
                }
            
                
            } 			
        });

        //Cihaz
        
        var chart = c3.generate({
        bindto: '#chart-Events-Interest', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', {{$cihaz[1]}}],
                ['data2', {{$cihaz[0]}}],
                ['data3', {{$cihaz[2]}}],
            ],
            type: 'pie', // default type of chart
            colors: {
                'data1': '#FC427B',
                'data2': '#8c7ae6',
                'data3': '#2ecc71',
            },
            names: {
                // name of each serie
                'data1': 'Mobil',
                'data2': 'Bilgisayar',
                'data3': 'Tablet',
            }
        },
        axis: {
        },
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 20,
            top: 0
        },
    });


    </script>
@endsection
