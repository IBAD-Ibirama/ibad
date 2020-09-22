@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      
      @role('admin')
      
      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>{{ $athlete->user->name }} - Gráficos de Evolução</span>
          <div>
            <a class="btn btn-warning btn-sm" href="{{ route('atletas.show', $athlete->id) }}"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
          </div>
        </div>
        <div class="card-body row">
          <div class="col">
            <div id="accordionPhyisicalTests">
              @foreach ($physicalTests as $physicalTest)
                <div class="card">
                  <div class="card-header" id="physicalTestHead_{{$physicalTest->id}}">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#physicalTestCollapse_{{$physicalTest->id}}" aria-expanded="true" aria-controls="collapseOne">
                        {{ $physicalTest->name }}
                      </button>
                    </h5>
                  </div>
              
                  <div id="physicalTestCollapse_{{$physicalTest->id}}" data-type="physical-test" data-id="{{ $physicalTest->id }}" class="collapse collapse-chart" aria-labelledby="physicalTestHead_{{$physicalTest->id}}" data-parent="#accordionPhyisicalTests">
                    <div class="card-body" style="height: 300px;"></div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          <div class="col">
            <div id="accordionBodyIndexes">
              @foreach ($bodyIndexes as $bodyIndex)
                <div class="card">
                  <div class="card-header" id="bodyIndexHead_{{$bodyIndex->id}}">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#bodyIndexCollapse_{{$bodyIndex->id}}" aria-expanded="true" aria-controls="collapseOne">
                        {{ $bodyIndex->name }}
                      </button>
                    </h5>
                  </div>
              
                  <div id="bodyIndexCollapse_{{$bodyIndex->id}}" data-type="body-index" data-id="{{ $bodyIndex->id }}" class="collapse collapse-chart" aria-labelledby="bodyIndexHead_{{$bodyIndex->id}}" data-parent="#accordionBodyIndexes">
                    <div class="card-body" style="height: 300px;"></div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      
      @else
      
      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endrole
    </div>
  </div>
</div>
@endsection

@section('script')
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

<script>
(function(document) {

  document.addEventListener('DOMContentLoaded', () => {

    const collapseCharts = document.querySelectorAll('.collapse-chart');

    const onShowCollapseChart = collapseChart => {
      const chartBody = collapseChart.querySelector('.card-body');
      if(!chartBody.childElementCount) {
        const chartType = collapseChart.getAttribute('data-type');
        const chartId = collapseChart.getAttribute('data-id');
        const chartUrl = (chartType == 'body-index') ? '@chart("evolucao-atleta-ajax-indices-corporais")' : '@chart("evolucao-atleta-ajax-testes-fisicos")';
        const chart = new Chartisan({
          el: chartBody,
          url: `${chartUrl}?athlete={{ $athlete->id }}&id=${chartId}`
        });
      }
    };

    const setCollapseEvent = () => {
      if(typeof $ !== 'undefined') {
        collapseCharts.forEach(collapseChart => {
          $(collapseChart).on('show.bs.collapse', () => onShowCollapseChart(collapseChart));
        });
      } else {
        setTimeout(setCollapseEvent, 500);
      }
    };

    setCollapseEvent();

  });

}(document));
</script>
@endsection