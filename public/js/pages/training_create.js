const inputLocal = document.querySelector('#training_local');
const optionLocal = document.querySelector('#localOption');


const auxiliaryForm = document.querySelector('#form-auxiliarys');
const auxiliaryTitle = document.querySelector('#titleAuxiliary');
const team = document.querySelector('#teamOption');

const auxiliary1 = document.querySelector('#auxiliary1');
const auxiliary2 =document.querySelector('#auxiliary2');

const initPeriodo = document.querySelector('#training_init');
const endPeriodo = document.querySelector('#training_repeat');
const diaDaSemana = document.querySelector('#day_select');
const diaDaSemanaView = document.querySelector('#day_select_view');
const numTreino = document.querySelector("#num_treino");

inputLocal.onchange = () => {
    optionLocal.selectedIndex = "0";
}

initPeriodo.onchange = () => {
    try {
      const [year, month, day] = initPeriodo.value.split('-');
      const date = new Date(year, month-1, day);
      const day2 = getDay(date.getDay());
      diaDaSemanaView.value = day2[0];
      diaDaSemana.value = day2[1];
      training_repeat.disabled = false;
      training_repeat.setAttribute("min", `${year}-${month}-${day}`);
    } catch (error) {
      training_repeat.disabled = true;
      training_repeat.removeAttribute("min");
    }
}

endPeriodo.onchange = () => {
  const [initYear, initMonth, initDay] = initPeriodo.value.split('-');
  const initDate = new Date(initYear, initMonth-1, initDay);

  const [endYear, endMonth, endDay] = endPeriodo.value.split('-');
  const endDate = new Date(endYear, endMonth-1, endDay);

  const timeDiff = Math.abs(endDate.getTime() - initDate.getTime());
  const diffDays = Math.trunc(Math.ceil(timeDiff / (1000 * 3600 * 24)) / 7 + 1);
  numTreino.value = `${diffDays}`;
}

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
          return ['Sabado', 'sa']
      case 0:
          return ['Domingo', 'su']
    }
}

function handleAuxiliaries(id){
  if(!id){
      auxiliaryForm.classList.remove('d-none');
      auxiliaryTitle.textContent = "Ajudantes:";
      return;
  }
  const teamNeedAuxiliary = teams_can_have_auxiliary.find(team => team.id == id);
  if(!teamNeedAuxiliary){
      auxiliary1.value= null;
      auxiliary2.value= null;
      auxiliaryTitle.textContent = "Essa turma não necessita ajudantes!";
      auxiliaryForm.classList.add('d-none');
  } else {
      auxiliaryForm.classList.remove('d-none');
      auxiliaryTitle.textContent = "Ajudantes:";
  }
}

team.onchange = () => {
  handleAuxiliaries(team.value);
}

optionLocal.onchange = () => {
    if(!optionLocal.value) {
        return;
    }
    const local = locals.find(local => local.id == optionLocal.value);
    inputLocal.value = local.description;
}
