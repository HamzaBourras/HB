
 /**** Get API ******/
let req = new XMLHttpRequest();

    req.open("get","https://jsonplaceholder.typicode.com/todos",false)
    let resp;

    req.onreadystatechange = () => {
        console.log(req.readyState);
        if(req.readyState===4 && req.status == 200){
            resp=JSON.parse(req.response);
            console.log(resp);
        }
    }

req.send();

    /** copier resp dans le tableau tabledata  **/
let Tabledata = [];
    for (let a = 0; a < resp.length; a++) {
        Tabledata.push(resp[a]);    
    }
    Tabledata.sort(function(a, b) {
        return b.id - a.id;
      });
    /* remplir le tableau */
let table = document.querySelector('.table');

    showList(Tabledata,table)


    /***** Add a to do *****/
let userId = document.querySelector('#userid');
let todo = document.querySelector('#todo');
let btnAdd = document.querySelector('#btn');


  let ID = resp.length;


    btnAdd.addEventListener('click',(e)=>{
        e.preventDefault(); //pour ne pas relaoder
        ID++;
        let User = {
            id: ID,
            userId : userId.value,
            title : todo.value,
            completed : false,
        }
        
        Tabledata.unshift(User);
        

        showList(Tabledata,table);
        
        
  
    })



    /***** une todo chercher  *****/
let todoSearche = document.querySelector('#todosearch');
let userSearche = document.querySelector('#usersearch');

    userSearche.addEventListener("input",()=>{
        let fdata=Tabledata.filter(e=>e.userId.toString().includes(userSearche.value))
        showList(fdata,table)
    })

    todoSearche.addEventListener("input",()=>{
        let fdata=Tabledata.filter(e=>e.title.includes(todoSearche.value))
       showList(fdata,table)
    })

    

    function showList(data,container){
    
        let txt=`<tr>
        <th >ID</th>
        <th>UserID</th>
        <th>Todo</th>
        <th>Completed</th>
    </tr>
        `
        //container.innerHTML=txt
           data.forEach(tr => {
            txt=txt+`<tr>
                        <td>${tr.id}</td>
                        <td>${tr.userId}</td>
                        <td>${tr.title}</td>
                        <td><input type="checkbox" ${tr.completed?'checked':""}/></td>
                    </tr>`
                    
            })
            container.innerHTML =txt
    }

