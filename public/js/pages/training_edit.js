const inputLocal = document.querySelector('#training_local');
const optionLocal = document.querySelector('#localOption');
const auxiliaryForm = document.querySelector('#form-auxiliarys');
const auxiliaryTitle = document.querySelector('#titleAuxiliary');
const team = document.querySelector('#teamOption');
const auxiliary1 = document.querySelector('#auxiliary1');
const auxiliary2 =document.querySelector('#auxiliary2');

const initPeriodo = document.querySelector('#training_init');
const diaDaSemana = document.querySelector('#day_select');
const diaDaSemanaView = document.querySelector('#day_select_view');
const numTreino = document.querySelector("#num_treino");

  inputLocal.onchange = () => {
      optionLocal.selectedIndex = "0";
  }

  initPeriodo.onchange = setDay;

  function setDay() {
      try {
        const [year, month, day] = initPeriodo.value.split('-');
        const date = new Date(year, month-1, day);
        const day2 = getDay(date.getDay());
        diaDaSemanaView.value = day2[0];
        diaDaSemana.value = day2[1];
      } catch (error) {
          console.log(error);
      }
  }

setDay();

  function getDay(index){
      switch (index){
        case 1:
            return ['Segunda-Feira', 'mo']
        case 2:
            return ['Terça-Feira', 'tu']
        case 3:
            return ['Quarta-Feira', 'we']
        case 4:
            return ['Quinta-Feira', 'th']
        case 5:
            return ['Sexta-Feira', 'fr']
        case 6:
            return ['Sábado', 'sa']
        case 0:
            return ['Domingo', 'su']
      }
  }

  function handleAuxiliaries(id){
    if(!id){
        auxiliaryForm.classList.remove('hide');
        auxiliaryTitle.textContent = "Ajudantes:";
        return;
    }
    const teamNeedAuxiliary = teams_can_have_auxiliary.find(team => team.id == id);
    if(!teamNeedAuxiliary){
        auxiliary1.value= null;
        auxiliary2.value= null;
        auxiliaryTitle.textContent = "Essa turma não necessita ajudantes!";
        auxiliaryForm.classList.add('hide');
    } else {
        auxiliaryForm.classList.remove('hide');
        auxiliaryTitle.textContent = "Ajudantes:";
    }
  }

  team.onchange = () => {
    handleAuxiliaries(team.value);
  }

  handleAuxiliaries(team.value);
  optionLocal.onchange = () => {
      if(!optionLocal.value) {
          return;
      }
      const local = locals.find(local => local.id == optionLocal.value);
      inputLocal.value = local.description;
  }
