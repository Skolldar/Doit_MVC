 // (function() {}); es un IIFE inmediatly invoque function expresion. protege el codigo y no se mezcle con otraa

 (function() {
    //boton para mostrar el modal de agg tarea
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', mostrarFormulario);

    function mostrarFormulario() {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        
        <form class="formulario nueva-tarea">
            <legend>Add a new Task</legend>

            <div class="campo">
                <label>Task</label>
                <input
                    type="text"
                    name="tarea"
                    placeholder="Add a task to your actual Project"
                    id="tarea"
                />
            </div>

            <div class="opciones">

                <input 
                type="submit"
                class="submit-nueva-tarea"
                value="Add new task"
                />
                

                <button 
                type="button" 
                class="cerrar-modal"
                >Cancel</button>

            </div>
        
        </form>
        `;

        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar'); 
        }, 0);

        modal.addEventListener('click', function(e){
            e.preventDefault();

            if(e.target.classList.contains('cerrar-modal') || e.target.classList.contains('modal')) { //delegetion!!!! se usa cuando usamos anteriormente INNERHTML
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');

                setTimeout(() => {
                    modal.remove();
                }, 500);
            }
        });

        document.querySelector('body').appendChild(modal);
    }
 })(); // () hace que se ejecute inmediatamente