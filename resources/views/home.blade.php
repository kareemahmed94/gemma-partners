@extends('layouts.master')
@section('title' , 'Home')
@section('style')
    <style>
        section.floating-header {
            box-shadow: 0 5px 15px 0 rgb(0 0 0 / 30%);
            background: #fff;
            position: relative;
            z-index: 2;
            height: 40px;
        }

        section.floating-header.floating-header nav.navbar.navbar-default {
            background-color: initial;
            border: 0;
            font-family: Montserrat-Medium;
            border-radius: 0;
            margin-bottom: 10px;
        }

        #map img {
            max-width: none !important;
        }

        .gm-style .gm-style-iw-d {
            overflow: hidden !important;
        }

        .gm-style .gm-style-iw-c {
            padding-right: 20px !important;
            padding-bottom: 20px !important;
            max-width: 654px !important;
            max-height: 200px !important;
            height: 200px !important;
        }

        .gm-style-iw-d {
            max-width: 654px !important;
            max-height: 200px !important;
            height: 200px !important;
        }

        .gm-style-iw {
            width: 350px !important;
            top: 15px !important;
            left: 0px !important;
            background-color: #fff;
            box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
            border: 1px solid rgba(72, 181, 233, 0.6);
            border-radius: 2px 2px 10px 10px;
        }

        #iw-container {
            margin-bottom: 10px;
        }

        #iw-container .iw-title {
            font-family: 'Open Sans Condensed', sans-serif;
            font-size: 15px;
            font-weight: 400;
            padding: 10px;
            background-color: #1a1a1a;
            color: white;
            margin: 0;
            border-radius: 2px 2px 0 0;
        }

        #iw-container .iw-content {
            font-size: 13px;
            line-height: 18px;
            font-weight: 400;
            margin-right: 1px;
            padding: 15px 5px 20px 15px;
            max-height: 140px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .iw-content img {
            float: right;
            margin: 0 5px 5px 10px;
        }

        .iw-subTitle {
            font-size: 16px;
            font-weight: 700;
            padding: 5px 0;
        }

        .iw-bottom-gradient {
            position: absolute;
            width: 326px;
            height: 25px;
            bottom: 10px;
            right: 18px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
            background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
            background: -moz-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
            background: -ms-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
        }

        #home_map {
            width: 100%;
            height: 500px;
            margin: 2% 0 20% 0;
            text-align: center;
            border: 5px solid #1a1a1a;
            border-radius: 10px
        }

        .color {
            float: left;
            width: 20px;
            height: 20px;
            margin: 5px;
            border: 1px solid rgba(0, 0, 0, .2);
        }

        .blue {
            background: #712bb3;
        }

        .red {
            background: #a12020;
        }

        .dark-blue {
            background: #001520;
        }

        .dark-grey {
            background: #171717;
        }

        .grey-blue {
            background: #30596f;
        }

        .brown {
            background: #605449;
        }

        .grey {
            background: #919191;
        }
    </style>
@stop

@section('content')

    <section id="partners" class="container">
        <div class="row" style="margin-top: 4%">
            <div class="col-md-2">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div class="color dark-grey"></div>
                        وكيل
                    </li>
                    <li>
                        <div class="color red"></div>
                        الجوهرة
                    </li>
                    <li>
                        <div class="color grey-blue"></div>
                        مرشح
                    </li>

                </ul>
            </div>

            <div class="col-md-2">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div class="color grey"></div>
                        عميل نقدي
                    </li>
                    <li>
                        <div class="color dark-blue"></div>
                        مباشر
                    </li>
                    <li>
                        <div class="color brown"></div>
                        غير مباشر جديد
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div class="color blue"></div>
                        غير مباشر قديم
                    </li>
                </ul>

            </div>
        </div>
        <form class="row" style="margin-top: 2%">
            <div class="col-md-3">
                <select class="form-control" v-model="type" @change="getPartners">
                    <option value="">التصنيف</option>
                    <option :value="option" v-for="option in type_options">@{{ option }}</option>

                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" v-model="city" @change="getPartners">
                    <option value="">المحافظة</option>
                        <option :value="option" v-for="option in city_options">@{{ option }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-dark" @click="getPartners">بحث</button>
            </div>

        </form>
        <div class="text-center" style="margin-top: 2%" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div id="home_map"></div>
            </div>
        </div>
    </section>
    <!-- Content -->

@stop
@section('script')


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBquDo_Py_LXm6FtPQEo-LXeLjFzIopLSg&amp"></script>

    <script>
        let loader = '<div id="spinner-wrapper">\n' +
            '    <div class="heart-rate">\n' +
            '        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="150px" height="73px" viewBox="0 0 150 73" enable-background="new 0 0 150 73" xml:space="preserve">\n' +
            '            <polyline fill="none" stroke="#009B9E" stroke-width="3" stroke-miterlimit="10" points="0,45.486 38.514,45.486 44.595,33.324 50.676,45.486 57.771,45.486 62.838,55.622 71.959,9 80.067,63.729 84.122,45.486 97.297,45.486 103.379,40.419 110.473,45.486 150,45.486"/>\n' +
            '        </svg>\n' +
            '        <div class="rate-fade-in"></div>\n' +
            '        <div class="rate-fade-out"></div>\n' +
            '    </div>\n' +
            '</div>';
        let x = 0;
        let baseUrl = "{!! url('/') !!}";
        new Vue({
            el: "#partners",
            data: function () {
                return {
                    partners: {},
                    types: [],
                    type_options: [],
                    city_options: [],
                    ids: {},
                    lats: {},
                    lngs: {},
                    type: '',
                    city: '',
                    loading: false,
                    lat: '',
                    lng: '',
                    url: baseUrl + '/hospitals',
                }
            },
            async mounted() {
                await this.getPartners(1);
            },
            methods: {
                map: function () {
                    // Creating a new map
                    var map = new google.maps.Map(document.getElementById("home_map"), {
                        center: new google.maps.LatLng(this.lat, this.lng),
                        // disableDefaultUI: true,
                        navigationControl: true,
                        mapTypeControl: true,
                        scaleControl: true,
                        draggable: true,
                        streetViewControl: true,
                        disableDoubleClickZoom: false,
                        scrollwheel: true,
                        zoom: 10,
                        minZoom: 2,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: [
                            {
                                "featureType": "administrative",
                                "elementType": "labels.text",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative.locality",
                                "elementType": "labels.text",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative.neighborhood",
                                "elementType": "labels.text",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape.man_made",
                                "elementType": "labels.text",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape.natural",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#e0efef"
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape.natural",
                                "elementType": "labels.text",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "visibility": "on"
                                    },
                                    {
                                        "hue": "#1900ff"
                                    },
                                    {
                                        "color": "#c0e8e8"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "labels.text",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "labels.icon",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "lightness": 100
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "labels",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "labels.text",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "labels.icon",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit.line",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "visibility": "on"
                                    },
                                    {
                                        "lightness": 700
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "color": "#7dcdcd"
                                    }
                                ]
                            }
                        ]

                    });


                    // Creating a global infoWindow object that will be reused by all markers
                    var infoWindow = new google.maps.InfoWindow();
                    var id;
                    // Looping through the JSON data
                    for (i = 0, length = this.ids.length; i < length; i++) {
                        var x = this;
                        // var address = data.address;
                        latLng = new google.maps.LatLng(this.lats[i], this.lngs[i]);
                        if (this.types[i] === 'وكيل') {
                            var icon = "{!! asset('1.png') !!}";
                        } else if (this.types[i] === 'الجوهرة') {
                            var icon = "{!! asset('2.png') !!}";
                        } else if (this.types[i] === 'مرشح') {
                            var icon = "{!! asset('3.png') !!}";
                        } else if (this.types[i] === 'مباشر') {
                            var icon = "{!! asset('4.png') !!}";
                        } else if (this.types[i] === 'غير مباشر جديد') {
                            var icon = "{!! asset('5.png') !!}";
                        } else if (this.types[i] === 'غير مباشر قديم') {
                            var icon = "{!! asset('6.png') !!}";
                        } else {
                            var icon = "{!! asset('7.png') !!}";
                        }

                        // Creating a marker and putting it on the map
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            icon: icon,
                        });
                        id = x.ids[i];
                        // Creating a closure to retain the correct data, notice how I pass the current data in the loop into the closure (marker, data)
                        (function (marker, id) {
                            // Attaching a click event to the current marker
                            google.maps.event.addListener(marker, "click", function (e) {
                                infoWindow.open(map, marker);
                                x.showPartner(id);
                            });

                        })(marker, id);
                    }
                },
                showPartner(id) {
                    $.ajax({
                        url: baseUrl + '/partners/' + id,
                        type: 'GET',
                        data: {
                            _token: "{!! csrf_token() !!}"
                        }
                    }).then((response) => {
                        var content = ' <div id="iw-container">\n' +
                            '        <div class="iw-title">' + response.data.name + '</div>\n' +
                            '        <div class="iw-content">\n' +
                            '            <div class="iw-subTitle">التصنيف</div>\n' +
                            response.data.type +
                            '            <div class="iw-subTitle">العنوان</div>\n' +
                            response.data.address +
                            '        </div>\n' +
                            '    </div>';
                        $(".gm-style-iw-d").html(content);
                    })
                },
                getPartners: function () {
                    this.loading = true
                    $.ajax({
                        url: '/partners',
                        type: 'GET',
                        data: {
                            _token: "{!! csrf_token() !!}",
                            type: this.type,
                            city: this.city,
                        }
                    }).then((response) => {
                        this.type_options = response.types
                        this.city_options = response.cities
                        this.partners = response.data
                        this.types = response.data.map(partner => {
                            return partner.type
                        });
                        this.lats = response.data.map(partner => {
                            return partner.lat
                        });
                        this.lngs = response.data.map(partner => {
                            return partner.lng
                        });
                        this.ids = response.data.map(partner => {
                            return partner.id
                        });
                        this.lat = response.lat;
                        this.lng = response.lng;
                        this.map();
                        this.loading = false

                        x++;
                    })
                },
            },
        })
        ;
    </script>
@stop
