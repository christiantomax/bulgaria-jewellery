@extends('v_main')

@section('title','Agenda')

@section('content')

<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />

<!-- Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Dashboard</b></h1>
                </div>    
                <div class="col-sm-6" style="display: flex; align-items: center;">
                    <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
                </div>
            </div>

            <br>
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card elevation-2" style="padding: 0px 0px 30px 0px;">
                            <div class="card-header" style="margin-bottom: 1%;">
                                <div class="row">
                                    <h2 class="col-9 card-title"><b>Agenda</b></h2>
                                    <div class="col-3" style="float:right;">
                                        <button type="button" class="btn btn-success" onclick="showmodaladdagenda()" style="width: 100%; font-weight: bold;">New Agenda</button>
                                    </div>
                                </div>
                            </div>
                            <div class="container theme-showcase">
                                <div id="holder" class="row"></div>
                            </div>
                            <script type="text/tmpl" id="tmpl">
                                @{{ 
                                var date = date || new Date(),
                                    month = date.getMonth(), 
                                    year = date.getFullYear(), 
                                    first = new Date(year, month, 1), 
                                    last = new Date(year, month + 1, 0),
                                    startingDay = first.getDay(), 
                                    thedate = new Date(year, month, 1 - startingDay),
                                    dayclass = lastmonthcss,
                                    today = new Date(),
                                    i, j; 
                                if (mode === 'week') {
                                    thedate = new Date(date);
                                    thedate.setDate(date.getDate() - date.getDay());
                                    first = new Date(thedate);
                                    last = new Date(thedate);
                                    last.setDate(last.getDate()+6);
                                } else if (mode === 'day') {
                                    thedate = new Date(date);
                                    first = new Date(thedate);
                                    last = new Date(thedate);
                                    last.setDate(thedate.getDate() + 1);
                                }
                                
                                }}
                                <table class="calendar-table table table-condensed table-tight" style="width:100%;">
                                    <thsead>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">
                                        <table style="white-space: nowrap; width: 100%">
                                            <tr>
                                            <td style="text-align: left;">
                                                <span class="btn-group">
                                                <button class="js-cal-prev btn btn-light"><</button>
                                                <button class="js-cal-next btn btn-light  ">></button>
                                                </span>
                                                <button class="js-cal-option btn btn-light @{{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="@{{: today.toISOString()}}" data-mode="month">@{{: todayname }}</button>
                                            </td>
                                            <td style="text-align: center;">
                                                <span class="btn-group btn-group-lg">
                                                @{{ if (mode !== 'day') { }}
                                                    @{{ if (mode === 'month') { }}<button class="js-cal-option btn btn-link" data-mode="year" style="padding-top:0px;"><h4>@{{: months[month] }}</h4></button>@{{ } }}
                                                    @{{ if (mode ==='week') { }}
                                                    <button class="btn btn-link disabled" style="padding-top:0px;"><h4>@{{: shortMonths[first.getMonth()] }} @{{: first.getDate() }} - @{{: shortMonths[last.getMonth()] }} @{{: last.getDate() }}</h4></button>
                                                    @{{ } }}
                                                    <button class="js-cal-years btn btn-link" style="padding-top:0px;"><h4>@{{: year}}</h4></button> 
                                                @{{ } else { }}
                                                    <button class="btn btn-link disabled" style="padding-top:0px;"><h4>@{{: date.toDateString() }}</h4></button> 
                                                @{{ } }}
                                                </span>
                                            </td>
                                            <td style="text-align: right">
                                                <span class="btn-group" role="group">
                                                <button type="button" class="js-cal-option btn btn-light @{{: mode==='year'? 'active':'' }}" data-mode="year">Year</button>
                                                <button type="button" class="js-cal-option btn btn-light @{{: mode==='month'? 'active':'' }}" data-mode="month">Month</button>
                                                <button type="button" class="js-cal-option btn btn-light @{{: mode==='week'? 'active':'' }}" data-mode="week">Week</button>
                                                </span>
                                            </td>
                                            </tr>
                                        </table>
                                        
                                        </td>
                                    </tr>
                                    </thead>
                                </table>
                                <table class="calendar-table table table-condensed table-tight" style="width:100%;">
                                    
                                    @{{ if (mode ==='year') {
                                    month = 0;
                                    }}
                                    <tbody>
                                    @{{ for (j = 0; j < 3; j++) { }}
                                    <tr>
                                        @{{ for (i = 0; i < 4; i++) { }}
                                        <td class="calendar-month month-@{{:month}} js-cal-option" data-date="@{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
                                        @{{: months[month] }}
                                        @{{ month++;}}
                                        </td>
                                        @{{ } }}
                                    </tr>
                                    @{{ } }}
                                    </tbody>
                                    @{{ } }}
                                    @{{ if (mode ==='month' || mode ==='week') { }}
                                    <thead>
                                    <tr class="c-weeks">
                                        @{{ for (i = 0; i < 7; i++) { }}
                                        <th class="c-name">
                                            @{{: days[i] }}
                                        </th>
                                        @{{ } }}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @{{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
                                    <tr>
                                        @{{ for (i = 0; i < 7; i++) { }}
                                        @{{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
                                        <td class="calendar-day @{{: dayclass }} @{{: thedate.toDateCssClass() }} @{{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} @{{: daycss[i] }} js-cal-option" data-date="@{{: thedate.toISOString() }}">
                                        <div class="date">@{{: thedate.getDate() }}</div>
                                        @{{ thedate.setDate(thedate.getDate() + 1);}}
                                        </td>
                                        @{{ } }}
                                    </tr>
                                    @{{ } }}
                                    </tbody>
                                    @{{ } }}
                                    @{{ if (mode ==='day') { }}
                                    <tbody>
                                    <tr>
                                        <td colspan="7">
                                        <table class="table table-striped table-condensed table-tight-vert" >
                                            <thead>
                                            <tr>
                                                <th> </th>
                                                <th style="text-align: center; width: 100%">@{{: days[date.getDay()] }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th class="timetitle" >All Day</th>
                                                <td class="@{{: date.toDateCssClass() }}">  </td>
                                            </tr>
                                            <tr>
                                                <th class="timetitle" >Before 6 AM</th>
                                                <td class="time-0-0"> </td>
                                            </tr>
                                            @{{for (i = 6; i < 22; i++) { }}
                                            <tr>
                                                <th class="timetitle" >@{{: i <= 12 ? i : i - 12 }} @{{: i < 12 ? "AM" : "PM"}}</th>
                                                <td class="time-@{{: i}}-0"> </td>
                                            </tr>
                                            <tr>
                                                <th class="timetitle" >@{{: i <= 12 ? i : i - 12 }}:30 @{{: i < 12 ? "AM" : "PM"}}</th>
                                                <td class="time-@{{: i}}-30"> </td>
                                            </tr>
                                            @{{ } }}
                                            <tr>
                                                <th class="timetitle" >After 10 PM</th>
                                                <td class="time-22-0"> </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                    @{{ } }}
                                </table>
                            </script>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

            <!-- Modal Detail Agenda -->
            <div class="modal fade" id="modal-detail-agenda">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="width: 150%;">
                        <div class="modal-header">
                            <h4 class="modal-title" id="agendaadddetailjudul">Detail Agenda</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row form-horizontal">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label" for="agendadetailtanggalmulai">Tanggal<a style="color:red;">*</a></label>
                                            <div class="col-sm-12">
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" readonly id="agendadetailtanggalmulai" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-horizontal">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label" for="agendadetailjudul">Judul<a style="color:red;">*</a></label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" readonly id="agendadetailjudul">
                                            <input type="hidden" class="form-control" id="agendadetailid">
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-horizontal">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label" for="agendadetailnote">Note Agenda<a style="color:red;">*</a></label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" readonly id="agendadetailnote" rows="8"></textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="display:block;">
                            <div class="row form-horizontal">
                                <div class="col-5">
                                    <button type="button" id="agendadetailbuttondelete" onclick="agendadelete()" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <button type="button" id="agendadetailbuttonupdate" onclick="agendaupdate()" class="btn btn-success"><i class="nav-icon fas fa-edit"></i></button>
                                </div>
                                <div class="col-7" style="text-align: right;">
                                    <button type="button" id="agendadetailbuttonsubmitupdate" onclick="validateupdateagenda()" style="display: none;" class="btn btn-primary"><b>Submit</b></button>
                                    <button type="button" id="agendadetailbuttonsubmitadd" onclick="validateaddagenda()" style="display: none;" class="btn btn-primary"><b>Submit</b></button>
                                    <button type="button" class="btn btn-danger" style="margin-left: 1%;" data-dismiss="modal"><b>Close</b></button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            @endsection

            @section('js')
            <script>
                var $currentPopover = null;
                $(document).on('shown.bs.popover', function(ev) {
                    var $target = $(ev.target);
                    if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
                        $currentPopover.popover('toggle');
                    }
                    $currentPopover = $target;
                }).on('hidden.bs.popover', function(ev) {
                    var $target = $(ev.target);
                    if ($currentPopover && ($currentPopover.get(0) == $target.get(0))) {
                        $currentPopover = null;
                    }
                });


                //quicktmpl is a simple template language I threw together a while ago; it is not remotely secure to xss and probably has plenty of bugs that I haven't considered, but it basically works
                //the design is a function I read in a blog post by John Resig (http://ejohn.org/blog/javascript-micro-templating/) and it is intended to be loosely translateable to a more comprehensive template language like mustache easily
                $.extend({
                    quicktmpl: function(template) {
                        return new Function("obj", "var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('" + template.replace(/[\r\t\n]/g, " ").split("@{{").join("\t").replace(/((^|\}\})[^\t]*)'/g, "$1\r").replace(/\t:(.*?)\}\}/g, "',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'") + "');}return p.join('');")
                    }
                });

                $.extend(Date.prototype, {
                    //provides a string that is _year_month_day, intended to be widely usable as a css class
                    toDateCssClass: function() {
                        return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate();
                    },
                    //this generates a number useful for comparing two dates; 
                    toDateInt: function() {
                        return ((this.getFullYear() * 12) + this.getMonth()) * 32 + this.getDate();
                    },
                    toTimeString: function() {
                        var hours = this.getHours(),
                            minutes = this.getMinutes(),
                            hour = (hours > 12) ? (hours - 12) : hours,
                            ampm = (hours >= 12) ? ' pm' : ' am';
                        if (hours === 0 && minutes === 0) {
                            return '';
                        }
                        if (minutes > 0) {
                            return hour + ':' + minutes + ampm;
                        }
                        return hour + ampm;
                    }
                });


                (function($) {

                    //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
                    var t = $.quicktmpl($('#tmpl').get(0).innerHTML);

                    function calendar($el, options) {
                        //actions aren't currently in the template, but could be added easily...
                        $el.on('click', '.js-cal-prev', function() {
                            switch (options.mode) {
                                case 'year':
                                    options.date.setFullYear(options.date.getFullYear() - 1);
                                    break;
                                case 'month':
                                    options.date.setMonth(options.date.getMonth() - 1);
                                    break;
                                case 'week':
                                    options.date.setDate(options.date.getDate() - 7);
                                    break;
                                case 'day':
                                    options.date.setDate(options.date.getDate() - 1);
                                    break;
                            }
                            draw();
                        }).on('click', '.js-cal-next', function() {
                            switch (options.mode) {
                                case 'year':
                                    options.date.setFullYear(options.date.getFullYear() + 1);
                                    break;
                                case 'month':
                                    options.date.setMonth(options.date.getMonth() + 1);
                                    break;
                                case 'week':
                                    options.date.setDate(options.date.getDate() + 7);
                                    break;
                                case 'day':
                                    options.date.setDate(options.date.getDate() + 1);
                                    break;
                            }
                            draw();
                        }).on('click', '.js-cal-option', function() {
                            var $t = $(this),
                                o = $t.data();
                            if (o.date) {
                                o.date = new Date(o.date);
                            }
                            $.extend(options, o);
                            draw();
                        }).on('click', '.js-cal-years', function() {
                            var $t = $(this),
                                haspop = $t.data('popover'),
                                s = '',
                                y = options.date.getFullYear() - 2,
                                l = y + 5;
                            if (haspop) {
                                return true;
                            }
                            for (; y < l; y++) {
                                s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">' + y + '</button>';
                            }
                            $t.popover({
                                content: s,
                                html: true,
                                placement: 'auto top'
                            }).popover('toggle');
                            return false;
                        }).on('click', '.event', function() {
                            var $t = $(this),
                                index = +($t.attr('data-index')),
                                haspop = $t.data('popover'),
                                data, time;

                            if (haspop || isNaN(index)) {
                                return true;
                            }
                            data = options.data[index];
                            time = data.start.toTimeString();
                            if (time && data.end) {
                                time = time + ' - ' + data.end.toTimeString();
                            }
                            $t.data('popover', true);
                            $t.popover({
                                content: '<p><strong>' + time + '</strong></p>' + data.text,
                                html: true,
                                placement: 'auto left'
                            }).popover('toggle');
                            return false;
                        });

                        function dayAddEvent(index, event) {
                            if (!!event.allDay) {
                                monthAddEvent(index, event);
                                return;
                            }
                            var $event = $('<div/>', {
                                    'class': 'event',
                                    text: event.title,
                                    title: event.title,
                                    'data-index': index
                                }),
                                start = event.start,
                                end = event.end || start,
                                time = event.start.toTimeString(),
                                hour = start.getHours(),
                                timeclass = '.time-22-0',
                                startint = start.toDateInt(),
                                dateint = options.date.toDateInt(),
                                endint = end.toDateInt();
                            if (startint > dateint || endint < dateint) {
                                return;
                            }

                            if (!!time) {
                                $event.html('<strong>' + time + '</strong> ' + $event.html());
                            }
                            $event.toggleClass('begin', startint === dateint);
                            $event.toggleClass('end', endint === dateint);
                            if (hour < 6) {
                                timeclass = '.time-0-0';
                            }
                            if (hour < 22) {
                                timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
                            }
                            $(timeclass).append($event);
                        }

                        function monthAddEvent(index, event) {
                            var $event = $('<div/>', {
                                    'class': 'event',
                                    text: event.title,
                                    title: event.title,
                                    'data-index': index,
                                    'onclick': 'showmodaldetailagenda("'+event.id+'")'
                                }),
                                e = new Date(event.start),
                                dateclass = e.toDateCssClass(),
                                day = $('.' + e.toDateCssClass()),
                                empty = $('<div/>', {
                                    'class': 'clear event',
                                    html: ' '
                                }),
                                numbevents = 0,
                                time = event.start.toTimeString(),
                                endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
                                checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 40),
                                existing,
                                i;
                            $event.toggleClass('all-day', !!event.allDay);
                            if (!!time) {
                                $event.html('<strong>' + time + '</strong> ' + $event.html());
                            }
                            if (!event.end) {
                                $event.addClass('begin end asisisis');
                                $('.' + event.start.toDateCssClass()).append($event);
                                return;
                            }

                            while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
                                if (day.length) {
                                    existing = day.find('.event').length;
                                    numbevents = Math.max(numbevents, existing);
                                    for (i = 0; i < numbevents - existing; i++) {
                                        day.append(empty.clone());
                                    }
                                    day.append(
                                        $event.toggleClass('begin', dateclass === event.start.toDateCssClass()).toggleClass('end', dateclass === event.end.toDateCssClass())
                                    );
                                    $event = $event.clone();
                                    $event.html(' ');
                                }
                                e.setDate(e.getDate() + 1);
                                dateclass = e.toDateCssClass();
                                day = $('.' + dateclass);
                            }
                        }

                        function yearAddEvents(events, year) {
                            var counts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                            $.each(events, function(i, v) {
                                if (v.start.getFullYear() === year) {
                                    counts[v.start.getMonth()]++;
                                }
                            });
                            $.each(counts, function(i, v) {
                                if (v !== 0) {
                                    $('.month-' + i).append('<span class="badge">' + v + '</span>');
                                }
                            });
                        }

                        function draw() {
                            $el.html(t(options));
                            //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
                            $('.' + (new Date()).toDateCssClass()).addClass('today');
                            if (options.data && options.data.length) {
                                if (options.mode === 'year') {
                                    yearAddEvents(options.data, options.date.getFullYear());
                                } else if (options.mode === 'month' || options.mode === 'week') {
                                    $.each(options.data, monthAddEvent);
                                } else {
                                    $.each(options.data, dayAddEvent);
                                }
                            }
                        }

                        draw();
                    }

                    ;
                    (function(defaults, $, window, document) {
                        $.extend({
                            calendar: function(options) {
                                return $.extend(defaults, options);
                            }
                        }).fn.extend({
                            calendar: function(options) {
                                options = $.extend({}, defaults, options);
                                return $(this).each(function() {
                                    var $this = $(this);
                                    calendar($this, options);
                                });
                            }
                        });
                    })({
                        days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                        months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        shortMonths: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        date: (new Date()),
                        daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
                        todayname: "Today",
                        thismonthcss: "current",
                        lastmonthcss: "outside",
                        nextmonthcss: "outside",
                        mode: "month",
                        data: []
                    }, jQuery, window, document);

                })(jQuery);

                var data = [],
                    names = ['Pembayaran CO','Pembayaran PO'];

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type : "POST",
                    url : "{{ route('getagenda') }}",
                    data :{},
                    success:function(response){
                        var counter = response.length;
                        var i = 0;
                        for(;i < counter;i++){
                            tanggal = response[i]['TglMulai'].split("-");
                            data.push({
                                id:response[i]['id'],
                                title: response[i]['JudulAgenda'],
                                start:  new Date(tanggal[0],parseInt(tanggal[1], 10)-1,parseInt(tanggal[2], 10)),
                                end: null,
                                allDay:  response[i]['Status'],
                                text:  response[i]['NoteAgenda']
                            });
                        }
                        data.sort(function(a, b) {
                            return (+a.start) - (+b.start);
                        });

                        //data must be sorted by start date

                        //Actually do everything
                        $('#holder').calendar({
                            data: data
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Error: " + errorThrown); 
                    } 
                });

                data.sort(function(a, b) {
                    return (+a.start) - (+b.start);
                });

                //data must be sorted by start date

                //Actually do everything
                $('#holder').calendar({
                    data: data
                });
            </script>

            <script>
                $('#reservationdate').datetimepicker({
                    format: 'DD/MM/YYYY'
                });
                function showmodaldetailagenda(NoteAgenda) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type : "POST",
                        url : "{{ route('getagendabyid') }}",
                        data : {
                            "id" : NoteAgenda,
                        },
                        success:function(data){
                            $('#agendadetailtanggalmulai').val(data[0].TglMulai);
                            $('#agendadetailjudul').val(data[0].JudulAgenda);
                            $('#agendadetailnote').val(data[0].NoteAgenda);
                            $('#agendadetailid').val(data[0].id);

                            document.getElementById("agendadetailtanggalmulai").readOnly = true;
                            document.getElementById("agendadetailjudul").readOnly = true;
                            document.getElementById("agendadetailnote").readOnly = true;
                            
                            document.getElementById("agendadetailbuttondelete").style.display = "inline-block";
                            document.getElementById("agendadetailbuttonupdate").style.display = "inline-block";
                            document.getElementById("agendadetailbuttonsubmitupdate").style.display = "none";
                            document.getElementById("agendadetailbuttonsubmitadd").style.display = "none";

                            document.getElementById("agendaadddetailjudul").innerHTML = "Detail Agenda";

                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Error: " + errorThrown); 
                        } 
                    });
                    $('#modal-detail-agenda').modal('show');
                }

                function showmodaladdagenda(){
                    $('#agendadetailtanggalmulai').val('');
                    $('#agendadetailjudul').val('');
                    $('#agendadetailnote').val('');
                    $('#agendadetailid').val('');

                    document.getElementById("agendadetailtanggalmulai").readOnly = false;
                    document.getElementById("agendadetailjudul").readOnly = false;
                    document.getElementById("agendadetailnote").readOnly = false;
                    
                    document.getElementById("agendadetailbuttondelete").style.display = "none";
                    document.getElementById("agendadetailbuttonupdate").style.display = "none";
                    document.getElementById("agendadetailbuttonsubmitupdate").style.display = "none";
                    document.getElementById("agendadetailbuttonsubmitadd").style.display = "inline-block";

                    document.getElementById("agendaadddetailjudul").innerHTML = "New Agenda";
                    $('#modal-detail-agenda').modal('show');
                }
            </script>

            <script>
                function validateaddagenda(){
                    var validationString = "";
                    if ($('#agendaaddtanggalmulai').val() == '' ){
                        validationString += "[Tanggal] ";
                    }
                    if ($('#agendaaddjudul').val() == ''){
                        validationString += "[Judul] ";
                    }
                    if ($('#agendaaddnote').val() == '' ){
                        validationString += "[Note Agenda] ";
                    }
                    if(validationString != ""){
                        alert('Please check your data!\n'+validationString);
                    }else{
                        agendaaddpost();
                    }
                }

                function validateupdateagenda(){
                    var validationString = "";
                    if ($('#agendadetailtanggalmulai').val() == '' ){
                        validationString += "[Tanggal] ";
                    }
                    if ($('#agendadetailjudul').val() == ''){
                        validationString += "[Judul] ";
                    }
                    if ($('#agendadetailnote').val() == '' ){
                        validationString += "[Note Agenda] ";
                    }
                    if(validationString != ""){
                        alert('Please check your data!\n'+validationString);
                    }else{
                        agendaupdatepost();
                    }
                }

                function agendaupdate(){
                    document.getElementById("agendadetailtanggalmulai").readOnly = false;
                    document.getElementById("agendadetailjudul").readOnly = false;
                    document.getElementById("agendadetailnote").readOnly = false;
                    
                    document.getElementById("agendadetailbuttondelete").style.display = "none";
                    document.getElementById("agendadetailbuttonupdate").style.display = "none";
                    document.getElementById("agendadetailbuttonsubmitupdate").style.display = "inline-block";
                    
                    document.getElementById("agendaadddetailjudul").innerHTML = "Update Agenda";
                }

                function agendaupdatepost(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type : "POST",
                        url : "{{ route('agendaupdate') }}",
                        data : {
                            "TglMulai" : $('#agendadetailtanggalmulai').val(),
                            "JudulAgenda" : $('#agendadetailjudul').val(),
                            "NoteAgenda" : $('#agendadetailnote').val(),
                            "id" : $('#agendadetailid').val(),
                            "Status" : 1,
                        },
                        success:function(data){
                            if(data == "Berhasil"){
                                window.location = "http://127.0.0.1:8000/dashboard";
                            }else{
                                alert(data);
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Error: " + errorThrown); 
                        } 
                    });
                }

                function agendadelete(){
                    let text = "Apakah anda yakin ingin menghapus data agenda tersebut ?";
                    if (confirm(text) == true) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type : "POST",
                            url : "{{ route('agendadelete') }}",
                            data : {
                                "id" : $('#agendadetailid').val(),
                            },
                            success:function(data){
                                if(data == "Berhasil"){
                                    window.location = "http://127.0.0.1:8000/dashboard";
                                }else{
                                    alert(data);
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                alert("Error: " + errorThrown); 
                            } 
                        });
                    } 
                }

                function agendaaddpost(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type : "POST",
                        url : "{{ route('createagenda') }}",
                        data : {
                            "TglMulai" : $('#agendadetailtanggalmulai').val(),
                            "JudulAgenda" : $('#agendadetailjudul').val(),
                            "NoteAgenda" : $('#agendadetailnote').val(),
                            "Status" : 1,
                        },
                        success:function(data){
                            $('#agendadetailnote').val("");
                            $('#agendadetailjudul').val("");
                            $('#agendadetailtanggalmulai').val("");
                            alert("Data berhasil disimpan.");
                            $('#modal-detail-agenda').modal('hide');   
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Error: " + errorThrown); 
                        } 
                    });
                    window.location = "http://127.0.0.1:8000/dashboard";
                }
            </script>
            @endsection