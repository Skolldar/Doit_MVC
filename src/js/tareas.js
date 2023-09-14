 // (function() {}); es un IIFE inmediatly invoque function expresion. protege el codigo y no se mezcle con otraa

 (function() {

    obtenerTareas();
    let tareas = [];

    //boton para mostrar el modal de agg tarea
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', mostrarFormulario);

    async function obtenerTareas() {
        try {
            const id = obtenerProyecto();
            const url = `/api/tareas?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            tareas = resultado.tareas;
            mostrarTareas();
        } catch (error) {
            console.log(error);
        }
    }

    function mostrarTareas() {
        limpiarTareas(); 
        if(tareas.length === 0) {
            const contenedorTareas = document.querySelector('#listado-tareas');

            const textoNoTareas = document.createElement('LI');
            textoNoTareas.textContent = 'No hay Tareas';
            textoNoTareas.classList.add('no-tareas');

            contenedorTareas.appendChild(textoNoTareas);
            return;
        }

        const estados = {
            0: 'Pendiente',
            1: 'Completa'
        }

        tareas.forEach(tarea => {
            const contenedorTarea = document.createElement('LI');
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add('tarea');

            const nombreTarea = document.createElement('P');
            nombreTarea.textContent=tarea.nombre;

            const opcionesDiv = document.createElement('DIV');
            opcionesDiv.classList.add('opciones');
            

            //BOTONES
            const btnEstadoTarea = document.createElement('BUTTON');
            btnEstadoTarea.classList.add('estado-tarea');
            btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
            btnEstadoTarea.textContent = estados[tarea.estado];
            btnEstadoTarea.dataset.estadoTarea = tarea.estado;

            //doble click al estado
            btnEstadoTarea.ondblclick = function () {
                cambiarEstadoTarea({...tarea});
            }

            //BOTON ELIMINAR
            const btnEliminarTarea = document.createElement('BUTTON');
            btnEliminarTarea.classList.add('eliminarTarea');
            btnEliminarTarea.dataset.idTarea = tarea.id;
            btnEliminarTarea.textContent = 'Eliminar';

            //AGREGARlo a la PANTALLA
            opcionesDiv.appendChild(btnEstadoTarea);
            opcionesDiv.appendChild(btnEliminarTarea);

            contenedorTarea.appendChild(nombreTarea);
            contenedorTarea.appendChild(opcionesDiv);

            const listadoTareas = document.querySelector('#listado-tareas');
            listadoTareas.appendChild(contenedorTarea);
        });
    }

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

            if(e.target.classList.contains('submit-nueva-tarea')) {
                submitFormularioNuevaTarea();
            }
        });

        document.querySelector('.dashboard').appendChild(modal);
    }

    function submitFormularioNuevaTarea() {
        const tarea = document.querySelector('#tarea').value.trim(); //elimina ambas direcciones los espacios
        
        if(tarea === '') {
            //mostrar una alerta de error
            mostrarAlerta('Task name is required', 'error', 
            document.querySelector('.formulario legend'));
            return;
        }

        agregarTarea(tarea);
    }

    // Mestra un mensaje en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia) {
        //previene la creacion de varias alertas
        const alertaPrevia = document.querySelector('.alerta');
        if(alertaPrevia) {
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        //inserta la alerta antes del LEGEND
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling); 
        //parentElement, lo coloca una posicion mas arriba lo que es el padre.
        //nextElementSibling, se refiere al siguiente elemento dentro del padre que es conocido como hermano


        //Eliminar la alerta despues de 5s
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    //Consultar el servidor paara anadir una tarea al proyecto actual
    async function agregarTarea(tarea) {
        // Construir la petición
        const datos = new FormData();
        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = 'http://localhost:3000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            
            const resultado = await respuesta.json();
            
            mostrarAlerta(
                resultado.mensaje, 
                resultado.tipo, 
                document.querySelector('.formulario legend')
            );

            if(resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 2000);

                //AGREGAR el objeto de tareas al globarl de tareas
                const tareaObj = {
                    id: String(resultado.id),
                    nombre: tarea,
                    estado: "0",
                    proyectoId: resultado.proyectoId
                }

                tareas = [...tareas, tareaObj]; //hace una copia y lo agg
                mostrarTareas();
            }
        } catch (error) {
            console.log(error);
        } 
    }

    function cambiarEstadoTarea(tarea) {
        const nuevoEstado = tarea.estado === "1" ? "0" : "1";
        tarea.estado = nuevoEstado;
        actualizarTarea();
    }

    function actualizarTarea(tarea) {
        
    }

    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id;
    }

    function limpiarTareas() {
        const listadoTareas = document.querySelector('#listado-tareas');

        //Es mucho mas rapido el limpiado 
        while(listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }

}

 })(); // () hace que se ejecute inmediatamente
