!function(){!async function(){try{const a="/api/tareas?id="+n(),o=await fetch(a),c=await o.json();e=c.tareas,t()}catch(e){console.log(e)}}();let e=[];function t(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay Tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const o={0:"Pendiente",1:"Completa"};e.forEach(c=>{const r=document.createElement("LI");r.dataset.tareaId=c.id,r.classList.add("tarea");const s=document.createElement("P");s.textContent=c.nombre;const d=document.createElement("DIV");d.classList.add("opciones");const i=document.createElement("BUTTON");i.classList.add("estado-tarea"),i.classList.add(""+o[c.estado].toLowerCase()),i.textContent=o[c.estado],i.dataset.estadoTarea=c.estado,i.ondblclick=function(){!function(o){const c="1"===o.estado?"0":"1";o.estado=c,async function(o){const{estado:c,id:r,nombre:s,proyectoId:d}=o,i=new FormData;i.append("id",r),i.append("nombre",s),i.append("estado",c),i.append("proyectoId",n());try{const n="http://localhost:3000/api/tarea/actualizar",o=await fetch(n,{method:"POST",body:i}),s=await o.json();"exito"===s.respuesta.tipo&&(a(s.respuesta.mensaje,s.respuesta.tipo,document.querySelector(".contenedor-nueva-tarea")),e=e.map(e=>(e.id===r&&(e.estado=c),e)),t())}catch(e){console.log(e)}}(o)}({...c})};const l=document.createElement("BUTTON");l.classList.add("eliminarTarea"),l.dataset.idTarea=c.id,l.textContent="Eliminar",l.ondblclick=function(){!function(a){Swal.fire({title:"Do you want to delete?",showCancelButton:!0,confirmButtonText:"Yes",cancelButtonText:"No"}).then(o=>{o.isConfirmed&&async function(a){const{estado:o,id:c,nombre:r}=a,s=new FormData;s.append("id",c),s.append("nombre",r),s.append("estado",o),s.append("proyectoId",n());try{const n="http://localhost:3000/api/tarea/eliminar",o=await fetch(n,{method:"POST",body:s}),c=await o.json();c.resultado&&(swal.fire("Deleted!",c.mensaje,"success"),e=e.filter(e=>e.id!==a.id),t())}catch(e){}}(a)})}({...c})},d.appendChild(i),d.appendChild(l),r.appendChild(s),r.appendChild(d);document.querySelector("#listado-tareas").appendChild(r)})}function a(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}function n(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){const o=document.createElement("DIV");o.classList.add("modal"),o.innerHTML='\n        \n        <form class="formulario nueva-tarea">\n            <legend>Add a new Task</legend>\n\n            <div class="campo">\n                <label>Task</label>\n                <input\n                    type="text"\n                    name="tarea"\n                    placeholder="Add a task to your actual Project"\n                    id="tarea"\n                />\n            </div>\n\n            <div class="opciones">\n\n                <input \n                type="submit"\n                class="submit-nueva-tarea"\n                value="Add new task"\n                />\n                \n\n                <button \n                type="button" \n                class="cerrar-modal"\n                >Cancel</button>\n\n            </div>\n        \n        </form>\n        ',setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),o.addEventListener("click",(function(c){if(c.preventDefault(),c.target.classList.contains("cerrar-modal")||c.target.classList.contains("modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{o.remove()},500)}c.target.classList.contains("submit-nueva-tarea")&&function(){const o=document.querySelector("#tarea").value.trim();if(""===o)return void a("Task name is required","error",document.querySelector(".formulario legend"));!async function(o){const c=new FormData;c.append("nombre",o),c.append("proyectoId",n());try{const n="http://localhost:3000/api/tarea",r=await fetch(n,{method:"POST",body:c}),s=await r.json();if(a(s.mensaje,s.tipo,document.querySelector(".formulario legend")),"exito"===s.tipo){const a=document.querySelector(".modal");setTimeout(()=>{a.remove()},2e3);const n={id:String(s.id),nombre:o,estado:"0",proyectoId:s.proyectoId};e=[...e,n],t()}}catch(e){console.log(e)}}(o)}()})),document.querySelector(".dashboard").appendChild(o)}))}();