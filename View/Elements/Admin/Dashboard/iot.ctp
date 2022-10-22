<div class="row">
    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Start-ups Enrolled</h4>
            </div>
            <div class="box-body">
                <div id="research_project" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#996600', '#6e2ba5'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total No of Startups'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [
                            ['IotStartUp', iot_array['IotStartUp']['Target']['count'], 'IotStartUp-YearWise-Target', colors1[0]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [
                            ['IotStartUp', iot_array['IotStartUp']['Achieve']['count'], 'IotStartUp-YearWise-Achieved', colors1[1]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>

    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Employment Generated</h4>
            </div>
            <div class="box-body">
                <div id="research_project1" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#e91e63', '#03a9f4'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project1', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Employment Generated'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [

                            ['GeneratedEmployment', iot_array['GeneratedEmployment']['Target']['count'], 'GeneratedEmployment-YearWise-Target', colors1[0]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [

                            ['GeneratedEmployment', iot_array['GeneratedEmployment']['Achieve']['count'], 'GeneratedEmployment-YearWise-Achieved', colors1[1]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>

    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Intellectual Property</h4>
            </div>
            <div class="box-body">
                <div id="research_project2" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#ff661a', '#ff99ff', '#0099cc', '#993366'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project2', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Intellectual properties'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [

                            ['IotIntellectualProperty', iot_array['IotIntellectualProperty']['Target']['count'], 'IotIntellectualProperty-YearWise-Target', colors1[0]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [

                            ['IotIntellectualProperty', iot_array['IotIntellectualProperty']['Achieve']['count'], 'IotIntellectualProperty-YearWise-Achieved', colors1[1]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>

    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Fund Rised By Start-ups</h4>
            </div>
            <div class="box-body">
                <div id="research_project3" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>

    </div>
    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#b54d28', '#ffc107'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project3', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Fund Rised By Start-ups'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [

                            ['IotStartupsRisedFund', iot_array['IotStartupsRisedFund']['Target']['count'], 'IotStartupsRisedFund-YearWise-Target', colors1[0]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [

                            ['IotStartupsRisedFund', iot_array['IotStartupsRisedFund']['Achieve']['count'], 'IotStartupsRisedFund-YearWise-Achieved', colors1[1]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>

    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Events/Workshops Conducted</h4>
            </div>
            <div class="box-body">
                <div id="research_project4" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#FFB583', '#348C53'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project4', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Events/Workshops Conducted'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [


                            ['IotEventWorkshop', iot_array['IotEventWorkshop']['Target']['count'], 'IotEventWorkshop-YearWise-Target', colors1[0]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [

                            ['IotEventWorkshop', iot_array['IotEventWorkshop']['Achieve']['count'], 'IotEventWorkshop-YearWise-Achieved', colors1[1]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>

    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Industries Connected</h4>
            </div>
            <div class="box-body">
                <div id="research_project5" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<style>
    .highcharts-credits {
        display: none !important;
    }
</style>



<script>
    $(function() {
        var colors1 = ['#89adff', '#03a9f4'];

        var iot_array = <?= json_encode($iot_array) ?>;


        researchDrillDown = [];

        $.each(iot_array, function(index, value) {
            $.each(iot_array[index], function(index1, value1) {

                year = [];
                $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                    year.push(
                        [index2, value2, index + '-' + index2 + '-Target']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Target',
                        name: index + '-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear = [];
                $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                    achieveYear.push(
                        [index2, value2, index + '-' + index2 + '-Achieved']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Achieved',
                        name: index + '-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month = []
                    $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                        month.push([index5, parseInt(value5), index, index2]);
                        researchDrillDown.push({
                            id: index + '-' + index2 + '-Achieved',
                            name: index + '-' + index2 + '-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName', 'year']
                        });
                    });
                });
            });
        });



        Highcharts.chart('research_project5', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -20,
                    depth: 50,
                    viewDistance: 50
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Industries Connected'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                if (this.y > 0 && this.year != '' && this.year > 0) {
                                    $(this).loadModalData(this.shName, this.year, this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                    name: 'Target',
                    data: [

                        ['IotIndustryConnected', iot_array['IotIndustryConnected']['Target']['count'], 'IotIndustryConnected-YearWise-Target', colors1[0]],

                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[0]
                },
                {
                    name: 'Achieved',
                    data: [

                        ['IotIndustryConnected', iot_array['IotIndustryConnected']['Achieve']['count'], 'IotIndustryConnected-YearWise-Achieved', colors1[1]],

                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[1]
                }
            ],
            drilldown: {
                allowPointDrilldown: false,
                series: researchDrillDown
            }
        });

    });
</script>
<div class="row">
    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Academia Connected</h4>
            </div>
            <div class="box-body">
                <div id="research_project6" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#993366', '#6e2ba5'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project6', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Academia Connected'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [

                            ['IotAcademiaConnected', iot_array['IotAcademiaConnected']['Target']['count'], 'IotAcademiaConnected-YearWise-Target', colors1[0]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [

                            ['IotAcademiaConnected', iot_array['IotAcademiaConnected']['Achieve']['count'], 'IotAcademiaConnected-YearWise-Achieved', colors1[1]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>

    <div class="col-lg-6">

        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Delegations Hosted at COE</h4>
            </div>
            <div class="box-body">
                <div id="research_project7" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<style>
    .highcharts-credits {
        display: none !important;
    }
</style>



<script>
    $(function() {
        var colors1 = ['#996600', '#993366'];

        var iot_array = <?= json_encode($iot_array) ?>;


        researchDrillDown = [];

        $.each(iot_array, function(index, value) {
            $.each(iot_array[index], function(index1, value1) {

                year = [];
                $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                    year.push(
                        [index2, value2, index + '-' + index2 + '-Target']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Target',
                        name: index + '-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear = [];
                $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                    achieveYear.push(
                        [index2, value2, index + '-' + index2 + '-Achieved']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Achieved',
                        name: index + '-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month = []
                    $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                        month.push([index5, parseInt(value5), index, index2]);
                        researchDrillDown.push({
                            id: index + '-' + index2 + '-Achieved',
                            name: index + '-' + index2 + '-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName', 'year']
                        });
                    });
                });
            });
        });



        Highcharts.chart('research_project7', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -20,
                    depth: 50,
                    viewDistance: 50
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Delegations Hosted at COE'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                if (this.y > 0 && this.year != '' && this.year > 0) {
                                    $(this).loadModalData(this.shName, this.year, this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                    name: 'Target',
                    data: [

                        ['IotDelegation', iot_array['IotDelegation']['Target']['count'], 'IotDelegation-YearWise-Target', colors1[0]],

                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[0]
                },
                {
                    name: 'Achieved',
                    data: [

                        ['IotDelegation', iot_array['IotDelegation']['Achieve']['count'], 'IotDelegation-YearWise-Achieved', colors1[1]],

                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[1]
                }
            ],
            drilldown: {
                allowPointDrilldown: false,
                series: researchDrillDown
            }
        });

    });
</script>
<div class="row">
    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Pilots ProjectList</h4>
            </div>
            <div class="box-body">
                <div id="research_project8" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#346fc7', '#6e2ba5'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project8', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Pilots ProjectList'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [
                            ['IotPilotsProject', iot_array['IotPilotsProject']['Target']['count'], 'IotPilotsProject-YearWise-Target', colors1[0]],
                            
                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [
                            ['IotPilotsProject', iot_array['IotPilotsProject']['Achieve']['count'], 'IotPilotsProject-YearWise-Achieved', colors1[1]],
                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>
    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Global Conference Papers</h4>
            </div>
            <div class="box-body">
                <div id="research_project9" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<style>
    .highcharts-credits {
        display: none !important;
    }
</style>



<script>
    $(function() {
        var colors1 = ['#ff661a', '#ff99ff', '#0099cc', '#993366'];

        var iot_array = <?= json_encode($iot_array) ?>;


        researchDrillDown = [];

        $.each(iot_array, function(index, value) {
            $.each(iot_array[index], function(index1, value1) {

                year = [];
                $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                    year.push(
                        [index2, value2, index + '-' + index2 + '-Target']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Target',
                        name: index + '-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear = [];
                $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                    achieveYear.push(
                        [index2, value2, index + '-' + index2 + '-Achieved']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Achieved',
                        name: index + '-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month = []
                    $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                        month.push([index5, parseInt(value5), index, index2]);
                        researchDrillDown.push({
                            id: index + '-' + index2 + '-Achieved',
                            name: index + '-' + index2 + '-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName', 'year']
                        });
                    });
                });
            });
        });



        Highcharts.chart('research_project9', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -20,
                    depth: 50,
                    viewDistance: 50
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Global Conference Papers'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                if (this.y > 0 && this.year != '' && this.year > 0) {
                                    $(this).loadModalData(this.shName, this.year, this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                    name: 'Target',
                    data: [

                        ['IotGlobalConferencePaper', iot_array['IotGlobalConferencePaper']['Target']['count'], 'IotGlobalConferencePaper-YearWise-Target', colors1[0]],
                        ['IotGlobalConferencePaper', iot_array['IotGlobalConferencePaper']['Target']['count'], 'IotGlobalConferencePaper-YearWise-Target', colors1[0]],

                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[0]
                },
                {
                    name: 'Achieved',
                    data: [
                        ['IotGlobalConferencePaper', iot_array['IotGlobalConferencePaper']['Achieve']['count'], 'IotGlobalConferencePaper-YearWise-Achieved', colors1[1]],
                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[1]
                }
            ],
            drilldown: {
                allowPointDrilldown: false,
                series: researchDrillDown
            }
        });

    });
</script>
<div class="row">
    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Researchers Incubated</h4>
            </div>
            <div class="box-body">
                <div id="research_project10" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>



    <script>
        $(function() {
            var colors1 = ['#993366', '#0066ff'];

            var iot_array = <?= json_encode($iot_array) ?>;


            researchDrillDown = [];

            $.each(iot_array, function(index, value) {
                $.each(iot_array[index], function(index1, value1) {

                    year = [];
                    $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                        year.push(
                            [index2, value2, index + '-' + index2 + '-Target']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Target',
                            name: index + '-YearWise-Target',
                            data: year,
                            keys: ['name', 'y', 'drilldown']
                        });


                    });

                    achieveYear = [];
                    $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                        achieveYear.push(
                            [index2, value2, index + '-' + index2 + '-Achieved']
                        );
                        researchDrillDown.push({
                            id: index + '-YearWise-Achieved',
                            name: index + '-YearWise-Achieved',
                            data: achieveYear,
                            keys: ['name', 'y', 'drilldown']
                        });

                        month = []
                        $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                            month.push([index5, parseInt(value5), index, index2]);
                            researchDrillDown.push({
                                id: index + '-' + index2 + '-Achieved',
                                name: index + '-' + index2 + '-Achieved',
                                data: month,
                                keys: ['name', 'y', 'shName', 'year']
                            });
                        });
                    });
                });
            });



            Highcharts.chart('research_project10', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: -20,
                        depth: 50,
                        viewDistance: 50
                    },
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Researchers Incubated'
                    }
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        },
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    if (this.y > 0 && this.year != '' && this.year > 0) {
                                        $(this).loadModalData(this.shName, this.year, this.name);
                                    }
                                }
                            }
                        }
                    }
                },
                series: [{
                        name: 'Target',
                        data: [

                            ['IotIncubatedResearcher', iot_array['IotIncubatedResearcher']['Target']['count'], 'IotIncubatedResearcher-YearWise-Target', colors1[0]],
                            ['IotIncubatedResearcher', iot_array['IotIncubatedResearcher']['Target']['count'], 'IotIncubatedResearcher-YearWise-Target', colors1[0]],

                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[0]
                    },
                    {
                        name: 'Achieved',
                        data: [
                            ['IotIncubatedResearcher', iot_array['IotIncubatedResearcher']['Achieve']['count'], 'IotIncubatedResearcher-YearWise-Achieved', colors1[1]],
                        ],
                        keys: ['name', 'y', 'drilldown', 'color'],
                        color: colors1[1]
                    }
                ],
                drilldown: {
                    allowPointDrilldown: false,
                    series: researchDrillDown
                }
            });

        });
    </script>
    <div class="col-lg-6">
        <div class="box ">
            <div class=" box-header with-border">
                <h4 class="box-title text-info">Prototypes Showcased</h4>
            </div>
            <div class="box-body">
                <div id="research_project11" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<style>
    .highcharts-credits {
        display: none !important;
    }
</style>



<script>
    $(function() {
        var colors1 = ['#66ccff', '#336699', '#669999', '#993366'];

        var iot_array = <?= json_encode($iot_array) ?>;


        researchDrillDown = [];

        $.each(iot_array, function(index, value) {
            $.each(iot_array[index], function(index1, value1) {

                year = [];
                $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                    year.push(
                        [index2, value2, index + '-' + index2 + '-Target']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Target',
                        name: index + '-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear = [];
                $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                    achieveYear.push(
                        [index2, value2, index + '-' + index2 + '-Achieved']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Achieved',
                        name: index + '-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month = []
                    $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                        month.push([index5, parseInt(value5), index, index2]);
                        researchDrillDown.push({
                            id: index + '-' + index2 + '-Achieved',
                            name: index + '-' + index2 + '-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName', 'year']
                        });
                    });
                });
            });
        });



        Highcharts.chart('research_project11', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -20,
                    depth: 50,
                    viewDistance: 50
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Prototypes Showcased'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                if (this.y > 0 && this.year != '' && this.year > 0) {
                                    $(this).loadModalData(this.shName, this.year, this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                    name: 'Target',
                    data: [

                        ['IotShowcasedPrototype', iot_array['IotShowcasedPrototype']['Target']['count'], 'IotShowcasedPrototype-YearWise-Target', colors1[0]],
                        ['IotShowcasedPrototype', iot_array['IotShowcasedPrototype']['Target']['count'], 'IotShowcasedPrototype-YearWise-Target', colors1[0]],

                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[0]
                },
                {
                    name: 'Achieved',
                    data: [
                        ['IotShowcasedPrototype', iot_array['IotShowcasedPrototype']['Achieve']['count'], 'IotShowcasedPrototype-YearWise-Achieved', colors1[1]],
                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[1]
                }
            ],
            drilldown: {
                allowPointDrilldown: false,
                series: researchDrillDown
            }
        });

    });
</script>



<div class="row mt-15">
    <div class="col-12 mb-20">
    </div>
    <div class="col-12">
        <div class="box ">
            
            <div class="box-body">
                <div id="research_project12" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .highcharts-credits {
        display: none !important;
    }
</style>



<script>
    $(function() {
        var colors1 = ['#ff661a', '#6e2ba5'];

        var iot_array = <?= json_encode($iot_array) ?>;


        researchDrillDown = [];

        $.each(iot_array, function(index, value) {
            $.each(iot_array[index], function(index1, value1) {

                year = [];
                $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                    year.push(
                        [index2, value2, index + '-' + index2 + '-Target']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Target',
                        name: index + '-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear = [];
                $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                    achieveYear.push(
                        [index2, value2, index + '-' + index2 + '-Achieved']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Achieved',
                        name: index + '-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month = []
                    $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                        month.push([index5, parseInt(value5), index, index2]);
                        researchDrillDown.push({
                            id: index + '-' + index2 + '-Achieved',
                            name: index + '-' + index2 + '-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName', 'year']
                        });
                    });
                });
            });
        });



        Highcharts.chart('research_project12', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -20,
                    depth: 50,
                    viewDistance: 50
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Mentoring / IotWorkshop / Investor Connect / Demo Days / Startup Showcase / Enterprise Connect'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                if (this.y > 0 && this.year != '' && this.year > 0) {
                                    $(this).loadModalData(this.shName, this.year, this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                    name: 'Target',
                    data: [

                        ['Mentoring', iot_array['Mentoring']['Target']['count'], 'Mentoring-YearWise-Target', colors1[0]],
                        ['IotWorkshop', iot_array['IotWorkshop']['Target']['count'], 'IotWorkshop-YearWise-Target', colors1[0]],
                        ['Investor Connect', iot_array['Investor Connect']['Target']['count'], 'Investor Connect-YearWise-Target', colors1[0]],
                        ['Demo Days', iot_array['Demo Days']['Target']['count'], 'Demo Days-YearWise-Target', colors1[0]],
                        ['Startup Showcase', iot_array['Startup Showcase']['Target']['count'], 'Startup Showcase-YearWise-Target', colors1[0]],
                        ['Enterprise Connect', iot_array['Enterprise Connect']['Target']['count'], 'Enterprise Connect-YearWise-Target', colors1[0]],


                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[0]
                },
                {
                    name: 'Achieved',
                    data: [
                        ['Mentoring', iot_array['Mentoring']['Achieve']['count'], 'Mentoring-YearWise-Achieved', colors1[1]],
                        ['IotWorkshop', iot_array['IotWorkshop']['Achieve']['count'], 'IotWorkshop-YearWise-Achieved', colors1[1]],
                        ['Investor Connect', iot_array['Investor Connect']['Achieve']['count'], 'Investor Connect-YearWise-Achieved', colors1[1]],
                        ['Demo Days', iot_array['Demo Days']['Achieve']['count'], 'Demo Days-YearWise-Achieved', colors1[1]],
                        ['Startup Showcase', iot_array['Startup Showcase']['Achieve']['count'], 'Startup Showcase-YearWise-Achieved', colors1[1]],
                        ['Enterprise Connect', iot_array['Enterprise Connect']['Achieve']['count'], 'Enterprise Connect-YearWise-Achieved', colors1[1]],
                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[1]
                }
            ],
            drilldown: {
                allowPointDrilldown: false,
                series: researchDrillDown
            }
        });

    });
</script>

<div class="row mt-15">
    <div class="col-12 mb-20">
    </div>
    <div class="col-12">
        <div class="box ">
            
            <div class="box-body">
                <div id="research_project13" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .highcharts-credits {
        display: none !important;
    }
</style>



<script>
    $(function() {
        var colors1 = ['#993366', '#6e2ba5'];

        var iot_array = <?= json_encode($iot_array) ?>;


        researchDrillDown = [];

        $.each(iot_array, function(index, value) {
            $.each(iot_array[index], function(index1, value1) {

                year = [];
                $.each(iot_array[index]['Target']['Year'], function(index2, value2) {
                    year.push(
                        [index2, value2, index + '-' + index2 + '-Target']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Target',
                        name: index + '-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear = [];
                $.each(iot_array[index]['Achieve']['Year'], function(index2, value2) {
                    achieveYear.push(
                        [index2, value2, index + '-' + index2 + '-Achieved']
                    );
                    researchDrillDown.push({
                        id: index + '-YearWise-Achieved',
                        name: index + '-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month = []
                    $.each(iot_array[index]['Achieve'][index2], function(index5, value5) {
                        month.push([index5, parseInt(value5), index, index2]);
                        researchDrillDown.push({
                            id: index + '-' + index2 + '-Achieved',
                            name: index + '-' + index2 + '-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName', 'year']
                        });
                    });
                });
            });
        });



        Highcharts.chart('research_project13', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -20,
                    depth: 50,
                    viewDistance: 50
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Shark Tank / Boot Camp / International Connect / Soft Landing / EDP in Tier / Women Entrepreneurs'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                if (this.y > 0 && this.year != '' && this.year > 0) {
                                    $(this).loadModalData(this.shName, this.year, this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                    name: 'Target',
                    data: [

                        // ['Mentoring', iot_array['IotInvestorConnect']['Target']['count'], 'Mentoring-YearWise-Target', colors1[0]],
                        ['Shark Tank', iot_array['Shark Tank']['Target']['count'], 'Shark Tank-YearWise-Target', colors1[0]],
                        ['Boot Camp', iot_array['Boot Camp']['Target']['count'], 'Boot Camp-YearWise-Target', colors1[0]],
                        ['International Connect', iot_array['International Connect']['Target']['count'], 'International Connect-YearWise-Target', colors1[0]],
                        ['Soft Landing', iot_array['Soft Landing']['Target']['count'], 'Soft Landing-YearWise-Target', colors1[0]],
                        ['EDP in Tier', iot_array['EDP in Tier']['Target']['count'], 'EDP in Tier-YearWise-Target', colors1[0]],
                        ['Women Entrepreneurs', iot_array['Women Entrepreneurs']['Target']['count'], 'Women Entrepreneurs-YearWise-Target', colors1[0]],


                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[0]
                },
                {
                    name: 'Achieved',
                    data: [
                        //  ['Mentoring', iot_array['IotInvestorConnect']['Achieve']['count'], 'Mentoring-YearWise-Achieved', colors1[1]],
                        ['Shark Tank', iot_array['Shark Tank']['Achieve']['count'], 'Shark Tank-YearWise-Achieved', colors1[1]],
                        ['Boot Camp', iot_array['Boot Camp']['Achieve']['count'], 'Boot Camp-YearWise-Achieved', colors1[1]],
                        ['International Connect', iot_array['International Connect']['Achieve']['count'], 'International Connect-YearWise-Achieved', colors1[1]],
                        ['Soft Landing', iot_array['Soft Landing']['Achieve']['count'], 'Soft Landing-YearWise-Achieved', colors1[1]],
                        ['EDP in Tier', iot_array['EDP in Tier']['Achieve']['count'], 'EDP in Tier-YearWise-Achieved', colors1[1]],
                        ['Women Entrepreneurs', iot_array['Women Entrepreneurs']['Achieve']['count'], 'Women Entrepreneurs-YearWise-Achieved', colors1[1]],
                    ],
                    keys: ['name', 'y', 'drilldown', 'color'],
                    color: colors1[1]
                }
            ],
            drilldown: {
                allowPointDrilldown: false,
                series: researchDrillDown
            }
        });

    });
</script>