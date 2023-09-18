@extends('layouts1.app')
@section('style')
<style>
  .dropdown.main {
    display: inline-block;
    position: relative;
  }

  .dropdown.main select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    width: 200px;
    max-width: 100%;
  }

  .dropdown.main select:focus {
    outline: none;
    border-color: #888;
  }

  .dropdown.main select option {
    background-color: #fff;
    color: #333;
  }

  .dropdown.main label {
    margin-right: 8px;
    font-size: 14px;
    font-weight: bold;
  }
</style>
@endsection
@section('content')
<div class="page-wrapper">
  <div class="content container-fluid">
    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-2">
                <i class="fas fa-dollar-sign"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Total uang pemasukkan</div>
                <div class="dash-counts">
                  <p>Rp {{ number_format($user->histories->where('content', 'income')->sum('amount'), 0, '', '.') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-1">
                <i class="fas fa-dollar-sign"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Total uang Pengeluaran</div>
                <div class="dash-counts">
                  <p>Rp {{ number_format($user->histories->where('content', 'expenditure')->sum('amount'), 0, '', '.') }}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-3">
                <i class="fas fa-file-alt"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Total Pemasukan</div>
                <div class="dash-counts">
                  <p>{{ count($user->histories->where('content', 'income')) }}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-4">
                <i class="far fa-file"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Total Pengeluaran</div>
                <div class="dash-counts">
                  <p>{{ count($user->histories->where('content', 'expenditure')) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Analisa keungan</h5>

              <div class="dropdown main">
                <label for="chart_period_select">Periode:</label>
                <select id="chart_period_select">
                  <option value="daily" id="option_daily">Harian</option>
                  <option value="weekly" id="option_weekly">Mingguan</option>
                  <option value="monthly" id="option_monthly">Bulanan</option>
                  <option value="yearly" id="option_yearly">Tahunan</option>
                </select>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                <div class="w-md-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                  <div>
                    <span>Pemasukan</span>
                    <p class="h3 text-primary me-5" id="periode_pemasukan">Rp 0,00</p>
                  </div>
                  <div>
                    <span>Pengeluaran</span>
                    <p class="h3 text-warning me-5" id="periode_pengeluaran">Rp 0,00</p>
                  </div>

                </div>
              </div>
              <div id="sales_chart"></div>


            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="card">
            <div class="card-header">
              <div class="row align-center">
                <div class="col">
                  <h5 class="card-title">Pengeluaran terakhir</h5>
                </div>
                <div class="col-auto">
                  <a href="/income" class="btn-right btn btn-sm btn-outline-primary">
                    Lihat semua
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-stripped table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>Judul</th>
                      <th>Jumlah</th>
                      <th>Tanggal</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($expenditures as $expenditure)
                    <tr>
                      <td>
                        {{ $expenditure['title'] }}
                      </td>
                      <td>Rp {{ number_format($expenditure['amount'], 0, '', '.') }}</td>
                      <td>{{ date('d M Y', strtotime($expenditure['date'])) }}</td>
                      <td class="text-right">
                        <div class="dropdown dropdown-action">
                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="card">
            <div class="card-header">
              <div class="row align-center">
                <div class="col">
                  <h5 class="card-title">Pemasukan Terakhir</h5>
                </div>
                <div class="col-auto">
                  <a href="/expenditure" class="btn-right btn btn-sm btn-outline-primary">
                    Lihat semua
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>Judul</th>
                      <th>Jumlah</th>
                      <th>Tanggal</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($incomes as $income)
                    <tr>
                      <td>
                        {{ $income['title'] }}
                      </td>
                      <td>Rp {{ number_format($income['amount'], 0, '', '.') }}</td>
                      <td>{{ date('d M Y', strtotime($income['date'])) }}</td>
                      <td class="text-right">
                        <div class="dropdown dropdown-action">
                          <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                          </div>
                        </div>
                      </td>
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
  </div>
  @endsection
  @section('script')
  <script>
    $(async function(){
      const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
      const transactions = await fetch("{{ route('gethistory') }}", {
        method: "post",
        headers:{
          'Content-Type': 'application/json',
          "X-CSRF-Token": csrfToken,
      }
    }).then(response => response.json());

    if ($("#sales_chart").length > 0) {
      var columnCtx = document.getElementById("sales_chart");
      var columnChart;
      const pemasukan = document.getElementById("periode_pemasukan");
      const pengeluaran = document.getElementById("periode_pengeluaran");
      const rupiah = (number)=>{
        return new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR"
        }).format(number);
      }

      var data = {
        daily: generateDaily(transactions),
        weekly: generateWeekly(transactions),
        monthly: generateMonthly(transactions),
        yearly: generateYearly(transactions),
      };

      function generateDaily(transactions) {
        let labels = [];
        let received = [];
        let pending = [];

        for (var i = 7 - 1; i >= 0; i--) {
          var tanggal = new Date();
          tanggal.setDate(tanggal.getDate() - i);

          var hari = tanggal.toLocaleDateString("id-ID", {
            weekday: "long",
          });
          labels.push(hari);

          let receivedValue = transactions.filter(data => {
            let tanggalData = new Date(data.date);
            tanggalData.setHours(0,0,0,0);
            tanggalData = tanggalData.toLocaleDateString("id-ID", {
              dateStyle: "short"
            });
            tanggalSekarang = tanggal.toLocaleDateString("id-ID", {
              dateStyle: "short"
            });
            return tanggalData == tanggalSekarang && data.content == 'income';
          });

          let pendingValue = transactions.filter(data => {
            let tanggalData = new Date(data.date);
            tanggalData.setHours(0,0,0,0);
            tanggalData = tanggalData.toLocaleDateString("id-ID", {
              dateStyle: "short"
            });
            tanggalSekarang = tanggal.toLocaleDateString("id-ID", {
              dateStyle: "short"
            });
            return tanggalData == tanggalSekarang && data.content == 'expenditure';
          });

          if(receivedValue.length > 0){
            received.push(receivedValue[0].amount);
          } else {
            received.push(0);
          }

          if(pendingValue.length > 0){
            pending.push(pendingValue[0].amount);
          } else {
            pending.push(0);
          }
        }

        return {
          labels: labels,
          received: received,
          pending: pending,
        }
      }

      function generateWeekly(transactions){
        let labels = [];
        let received = [];
        let pending = [];

        let sekarang = new Date();
        bulanIni = sekarang.toLocaleDateString("id-ID", {month: "numeric", year: "numeric"})

        firstWeek = new Date();
        firstWeek.setDate(1)
        firstWeek.setHours(0,0,0,0)
        if(firstWeek.getDay() != 1){
          firstWeek.setDate(firstWeek.getDate() + (7 - firstWeek.getDay()) + 1);
        }
        let loop = true;
        let minggu = 1;
        while(loop){
          lastWeek = new Date(firstWeek);
          lastWeek.setDate(firstWeek.getDate() + 6);

          label = `Minggu ke ${minggu}`;
          labels.push(label);

          receivedValue = transactions.filter(data => {
            let tanggalData = new Date(data.date);
            tanggalData.setHours(0,0,0,0);

            return tanggalData >= firstWeek && tanggalData <= lastWeek && data.content == 'income';
          });
          pendingValue = transactions.filter(data => {
            let tanggalData = new Date(data.date);
            tanggalData.setHours(0,0,0,0);

            return tanggalData >= firstWeek && tanggalData <= lastWeek && data.content == 'expenditure';
          });

          if(receivedValue.length > 0){
            if(receivedValue.length == 1){
              received.push(receivedValue[0].amount);
            } else if (receivedValue.length > 1){
              let value = receivedValue.map(val => val.amount);
              let total = value.reduce((a, c) => a + c);
              received.push(total);
            }
          } else {
            received.push(0);
          }

          if(pendingValue.length > 0){
            if(pendingValue.length == 1){
              pending.push(pendingValue[0].amount);
            } else if (pendingValue.length > 1){
              let value = pendingValue.map(val => val.amount);
              let total = value.reduce((a, c) => a + c);
              pending.push(total);
            }
          } else {
            pending.push(0);
          }

          firstWeek.setDate(lastWeek.getDate() + 1);
          minggu++
          if(lastWeek.toLocaleDateString("id-ID", {month: "numeric", year: "numeric"}) != bulanIni){
            loop = false;
          }
        }

        return {
          labels: labels,
          received: received,
          pending: pending,
        }
      }

      function generateMonthly(transactions){
        let labels = [];
        let received = [];
        let pending = [];

        let sekarang = new Date();
        sekarang.setHours(0,0,0,0);
        sekarang.setDate(1);
        for(let i = 0;i < 12;i++){
          sekarang.setMonth(i);
          let first = new Date(sekarang);
          first.setDate(1);
          let last = new Date(sekarang);
          last.setMonth(sekarang.getMonth() + 1);
          last.setDate(sekarang.getDate() - 1);

          let label = sekarang.toLocaleDateString("id-ID", {month: "short"});
          labels.push(label);

          let receivedValue = transactions.filter(data => {
            tanggalData = new Date(data.date);
            tanggalData.setHours(0,0,0,0);

            return tanggalData >= first && tanggalData <= last && data.content == 'income';
          });
          let pendingValue = transactions.filter(data => {
            tanggalData = new Date(data.date);
            tanggalData.setHours(0,0,0,0);

            return tanggalData >= first && tanggalData <= last && data.content == 'expenditure';
          });

          if(receivedValue.length > 0){
            if(receivedValue.length == 1){
              received.push(receivedValue[0].amount);
            } else if (receivedValue.length > 1){
              let value = receivedValue.map(val => val.amount);
              let total = value.reduce((a, c) => a + c);
              received.push(total);
            }
          } else {
            received.push(0);
          }

          if(pendingValue.length > 0){
            if(pendingValue.length == 1){
              pending.push(pendingValue[0].amount);
            } else if (pendingValue.length > 1){
              let value = pendingValue.map(val => val.amount);
              let total = value.reduce((a, c) => a + c);
              pending.push(total);
            }
          } else {
            pending.push(0);
          }
        }

        return {
          labels: labels,
          received: received,
          pending: pending,
        }
      }

      function generateYearly(transactions){
        let labels = [];
        let received = [];
        let pending = [];

        for(let i = 4; i > 0; i--){
          let sekarang = new Date();

          let tahun = new Date(sekarang);
          tahun.setFullYear(sekarang.getFullYear() + 1 - i);

          let label = tahun.toLocaleDateString("id-ID", {year: "numeric"});
          labels.push(label);

          let receivedValue = transactions.filter(value => {
            let tahunValue = new Date(value.date);
            let labelValue = tahunValue.toLocaleDateString("id-ID", {year: "numeric"});

            return labelValue == label && value.content == 'income';
          });

          let pendingValue = transactions.filter(value => {
            let tahunValue = new Date(value.date);
            let labelValue = tahunValue.toLocaleDateString("id-ID", {year: "numeric"});

            return labelValue == label && value.content == 'expenditure';
          });

          if(receivedValue.length > 0){
            if(receivedValue.length == 1){
              received.push(receivedValue[0].amount);
            } else if (receivedValue.length > 1){
              let value = receivedValue.map(val => val.amount);
              let total = value.reduce((a, c) => a + c);
              received.push(total);
            }
          } else {
            received.push(0);
          }

          if(pendingValue.length > 0){
            if(pendingValue.length == 1){
              pending.push(pendingValue[0].amount);
            } else if (pendingValue.length > 1){
              let value = pendingValue.map(val => val.amount);
              let total = value.reduce((a, c) => a + c);
              pending.push(total);
            }
          } else {
            pending.push(0);
          }
        }
        return {
          labels: labels,
          received: received,
          pending: pending,
        }
      }

      var updateChart = function (jenis) {
        var dataTerpilih = data[jenis];

        var columnConfig = {
          colors: ["#7638ff", "#fda600"],
          series: [
            {
              name: "Pemasukan",
              type: "column",
              data: dataTerpilih.received,
            },
            {
              name: "Pengeluaran",
              type: "column",
              data: dataTerpilih.pending,
            },
          ],
          chart: {
            type: "bar",
            fontFamily: "Poppins, sans-serif",
            height: 350,
            toolbar: {
              show: false,
            },
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: "60%",
              endingShape: "rounded",
            },
          },
          dataLabels: {
            enabled: false,
          },
          stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
          },
          xaxis: {
            categories: dataTerpilih.labels,
          },
          yaxis: {
            title: {
              text: "Rp (ribuan)",
            },
            labels: {
              formatter: function (value) {
                return "Rp " + value.toLocaleString("id-ID");
              },
            },
          },
          fill: {
            opacity: 1,
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return "Rp " + val.toLocaleString("id-ID") + " ribu";
              },
            },
          },
        };

        if (columnChart) {
          columnChart.destroy();
        }

        columnChart = new ApexCharts(columnCtx, columnConfig);
        columnChart.render();
      };

      function total(array = []){
        return array.reduce((a,c) => a+c);
      }

      function updateTulisan(jenis){
        switch (jenis) {
          case "daily":
            let nilaiPemasukanDaily = total(data.daily.received);
            let nilaiPengeluaranDaily = total(data.daily.pending);
            pemasukan.innerHTML = rupiah(nilaiPemasukanDaily);
            pengeluaran.innerHTML = rupiah(nilaiPengeluaranDaily);
            break;
          case "weekly":
            let nilaiPemasukanWeekly = total(data.weekly.received);
            let nilaiPengeluaranWeekly = total(data.weekly.pending);
            pemasukan.innerHTML = rupiah(nilaiPemasukanWeekly);
            pengeluaran.innerHTML = rupiah(nilaiPengeluaranWeekly);
            break;
          case "monthly":
            let nilaiPemasukanMonthly = total(data.monthly.received);
            let nilaiPengeluaranMonthly = total(data.monthly.pending);
            pemasukan.innerHTML = rupiah(nilaiPemasukanMonthly);
            pengeluaran.innerHTML = rupiah(nilaiPengeluaranMonthly);
            break;
          case "yearly":
            let nilaiPemasukanYearly = total(data.yearly.received);
            let nilaiPengeluaranYearly = total(data.yearly.pending);
            pemasukan.innerHTML = rupiah(nilaiPemasukanYearly);
            pengeluaran.innerHTML = rupiah(nilaiPengeluaranYearly);
            break;
        }
      }

      updateChart("daily");
      updateTulisan("daily");


      $("#chart_period_select").on("change", function () {
        var jenisTerpilih = $(this).val();
        updateChart(jenisTerpilih);
        updateTulisan(jenisTerpilih);
      });
    }

    });
  </script>
  @endsection