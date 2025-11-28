// cursos.js
document.addEventListener('DOMContentLoaded', function() {
    // Dados dos cursos - substitua com os cursos reais da sua universidade
    const cursosPorArea = {
        "Exatas": ["Ciência da Computação", "Egenharia Civil", "Engenharia de Alimentos", "Engenharia Mecânica", "Engenharia de Produção"],
        "Humanas": ["Administração Portuária", "Agronomia"],
        "Biológicas": ["Biologia", "Medicina"]
        // Adicione mais áreas e cursos conforme necessário
    };

    const selectArea = document.getElementById('area');
    const selectCurso = document.getElementById('curso');

    // Preencher áreas
    if (selectArea) {
        Object.keys(cursosPorArea).forEach(area => {
            const option = document.createElement('option');
            option.value = area;
            option.textContent = area;
            selectArea.appendChild(option);
        });

        // Evento quando a área é selecionada
        selectArea.addEventListener('change', function() {
            const areaSelecionada = this.value;
            
            if (areaSelecionada) {
                selectCurso.disabled = false;
                selectCurso.innerHTML = '<option value="">Selecione o curso</option>';
                
                // Preencher cursos da área selecionada
                cursosPorArea[areaSelecionada].forEach(curso => {
                    const option = document.createElement('option');
                    option.value = curso;
                    option.textContent = curso;
                    selectCurso.appendChild(option);
                });
            } else {
                selectCurso.disabled = true;
                selectCurso.innerHTML = '<option value="">Primeiro selecione a área</option>';
            }
        });
    }
});