document.querySelector("#agregar-tarea").addEventListener("click",(function(){const e=document.createElement("DIV");e.classList.add("modal"),e.innerHTML='\n        \n        <form class="formulario nueva-tarea">\n            <legend>Add a new Task</legend>\n\n            <div class="campo">\n                <label>Task</label>\n                <input\n                    type="text"\n                    name="tarea"\n                    placeholder="Add a task to your actual Project"\n                    id="tarea"\n                />\n            </div>\n\n            <div class="opciones">\n\n                <input \n                type="submit"\n                class="submit-nueva-tarea"\n                value="Add new task"\n                />\n                \n\n                <button \n                type="button" \n                class="cerrar-modal"\n                >Cancel</button>\n\n            </div>\n        \n        </form>\n        ',setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),e.addEventListener("click",(function(t){t.preventDefault(),(t.target.classList.contains("cerrar-modal")||t.target.classList.contains("modal"))&&(document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{e.remove()},500)),t.target.classList.contains("submit-nueva-tarea")&&function(){const e=document.querySelector("#tarea").value.trim();""!==e||function(e,t,n){const a=document.querySelector(".alerta");a&&a.remove();const r=document.createElement("DIV");r.classList.add("alerta",t),r.textContent=e,n.parentElement.insertBefore(r,n.nextElementSibling),setTimeout(()=>{r.remove()},5e3)}("Task name is required","error",document.querySelector(".formulario legend"))}()})),document.querySelector(".dashboard").appendChild(e)}));