<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Evolução do Atleta</title>
    <style>
      .container {
        padding: 10px;
      }
      .evolution-charts {
        display: grid;
        grid-template-columns: 1fr 1fr;
      }
      .chart-container {
        height: 300px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="athlete row">
        <div>
          <label for="athlete-id">Atleta</label>
          <select name="athlete_id" id="athlete-id">
            <option value="">Selecione um atleta</option>
            @foreach ($athletes as $athlete)
                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="evolution-charts">
        <div class="body-index-charts">
          <h5>Índices Corporais</h5>
          <div class="evolution-charts-container">
            @foreach ($bodyIndexes as $bodyIndex)
              <div class="chart-container" data-type="body-index" data-id="{{ $bodyIndex->id }}"></div>
            @endforeach
          </div>
        </div>
        <div class="physical-test-charts">
          <h5>Testes Físicos</h5>
          <div class="evolution-charts-container">
            @foreach ($physicalTests as $physicalTest)
              <div class="chart-container" data-type="physical-test" data-id="{{ $physicalTest->id }}"></div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      (function() {
        document.addEventListener('DOMContentLoaded', () => {
          const athleteField = document.querySelector('#athlete-id');
          const charts = document.querySelectorAll('.chart-container');

          const onChangeAthleteField = () => {
            const athleteId = athleteField.value;
            charts.forEach(chartBody => {
              chartBody.innerHTML = '';
              if(athleteId) {
                const chartType = chartBody.getAttribute('data-type');
                const chartId = chartBody.getAttribute('data-id');
                const chartUrl = (chartType == 'body-index') ? '@chart("evolucao-atleta-ajax-indices-corporais")' : '@chart("evolucao-atleta-ajax-testes-fisicos")';
                const chart = new Chartisan({
                  el: chartBody,
                  url: `${chartUrl}?athlete=${athleteId}&id=${chartId}`
                });
              }
            });
          };

          athleteField.addEventListener('change', onChangeAthleteField);
        });
      }());
    </script>
  </body>
</html>