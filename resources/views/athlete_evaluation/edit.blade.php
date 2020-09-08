@extends('layouts.master')

@section('title', ($evaluation->exists ? 'Alterar' : 'Cadastrar') . ' Avaliação')
@section('subtitle', $athlete->name)

@section('content')
<div class="text-left">

  @if ($evaluation->exists)
  <form method="POST" action="{{ route('evaluations.update', $evaluation) }}">
    @method('PUT')
  @else
  <form method="POST" action="{{ route('evaluations.store') }}">
  @endif
    @csrf

    <input type="hidden" name="athlete_id" value="{{ $athlete->id }}">

    <div class="form-group">
      <label for="realization_date" class="@error('realization_date') text-danger @enderror">Data da Avaliação</label>
      <input type="date" class="form-control @error('realization_date') is-invalid @enderror" id="realization_date" name="realization_date" value="{{ old('realization_date', $evaluation->realization_date ?: date('Y-m-d')) }}" aria-describedby="realizationDateHelp" required>
      @error('realization_date') <small id="realizationDateHelp" class="form-text text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="row">
      <div class="col">
        <table class="table table-sm">
          <thead>
            <tr>
              <th width="70%">Teste Físico</th>
              <th width="30%">Valor</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($physicalTests as $physicalTest)
              <tr>
                <td>{{ $physicalTest->name }}</td>
                <td>
                  <input type="hidden" name="physicalTests[{{ $physicalTest->id }}][id]" value="{{ $physicalTest->id }}" readonly>
                  <input type="number" class="form-control form-control-sm" name="physicalTests[{{ $physicalTest->id }}][value]" value="{{ $evaluation->physicalTest($physicalTest)->value }}" placeholder="0,000" step="0.001">
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm">
          <thead>
            <tr>
              <th width="70%">Índice Corporal</th>
              <th width="30%">Valor</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bodyIndexes as $bodyIndex)
              <tr>
                <td>{{ $bodyIndex->name }}</td>
                <td>
                  <input type="hidden" name="bodyIndexes[{{ $bodyIndex->id }}][id]" value="{{ $bodyIndex->id }}" readonly>
                  <input type="number" class="form-control form-control-sm" name="bodyIndexes[{{ $bodyIndex->id }}][value]" value="{{ $evaluation->bodyIndex($bodyIndex)->value }}" placeholder="0,000" step="0.001">
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Gravar</button>
    <a class="btn btn-secondary" href={{ route('evaluations.index', compact('athlete')) }} role="button">Voltar para Avaliações</a>

  </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
(function(document) {
  document.addEventListener('DOMContentLoaded', () => {
    
    const evaluationForm = document.querySelector('form');
    const submitButton = document.querySelector('button[type="submit"]');
    const evaluationValues = Array.prototype.slice.call(document.querySelectorAll('[name*="[value]"]'));

    const thereIsSomeEvaluation = () => {
      return evaluationValues.some(evaluationValue => evaluationValue.value.trim().length > 0);
    };

    const reportValidityEvaluations = () => {
      let reportValidity = false;
      if(!thereIsSomeEvaluation()) {
        alert('É preciso informar pelo menos uma avaliação de teste físico ou de índice corporal.');
        reportValidity = true;
      }
      return reportValidity;
    };

    const onClickSubmitButton = event => {
      event.preventDefault();
      if(!evaluationForm.checkValidity()) {
        return evaluationForm.reportValidity();
      }
      if(!reportValidityEvaluations()) {
        evaluationForm.submit();
      }
    };

    submitButton.addEventListener('click', onClickSubmitButton);

  });
}(document));
</script>
@endsection