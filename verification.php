<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/root.css">
    <link rel="stylesheet" href="/assets/css/verification.css">
    <link rel="import" href="header.html">
    <title>PsihoDoc</title>
  </head>
  <body>
  <div class="page">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
      <main>
        <section>
          <div class="container">
            <div class="section__inner">
                <div class="up">
                    <div class="title-text">Верификация</div>
                    <div class="line">
                        <hr>
                        <div class="green-line"></div>
                    </div>
                </div>
                <form action="/assets/bd/verif.php" method="post" enctype="multipart/form-data">
                    <div class="title">Верификация</div>
                    <div class="d-title">Верифицируйтесь, чтобы принимать консультации</div>
                    <div class="ttl">Ваше Имя и Фамилия</div>
                    <input type="text" name="name" id="name" required placeholder="Введите ваше имя и фамилия">
                    <div class="ttl">Ваш возраст</div>
                    <input type="range" name="old" id="old" min="18" max="90" value="18" step="1">
                    <div class="range">
                      <div class="range-num">18 лет</div>
                      <div class="range-num" style="color: #B1DDCF;"><span id="r-old"></span>лет</div>
                      <div class="range-num">90 лет</div>
                    </div>
                    <div class="ttl">Цена за 60 минут</div>
                    <input type="range" name="price" id="price" min="0" max="20000" value="0" step="1">
                    <div class="range">
                      <div class="range-num">0грн</div>
                      <div class="range-num" style="color: #B1DDCF;"><span id="r-price"></span>грн</div>
                      <div class="range-num">20000грн</div>
                    </div>
                    <div class="ttl">Сколько лет практики</div>
                    <input type="range" name="year" id="year" min="0" max="100" value="0" step="1">
                    <div class="range">
                      <div class="range-num">0</div>
                      <div class="range-num" id="r-year" style="color: #B1DDCF;"></div>
                      <div class="range-num">100</div>
                    </div>
                    <div class="ttl">Направления работы</div>
                    <input type="text" name="vector" id="vector" placeholder="Арт-терапія">
                    <div class="enter">Когда заполните - нажмите Enter</div>
                    <input type="hidden" name="vector_hid" id="vector_hid">
                    <div class="enter-values vectors">
                      <div class="enter-value">Сексологія</div>
                      <div class="enter-value">Кризове консультування</div>
                    </div>
                    <div class="ttl">При какой проблеме к вам можно обратиться?</div>
                    <input type="text" name="problem" id="problem" placeholder="Пережити горе">
                    <div class="enter">Когда заполните - нажмите Enter</div>
                    <div class="enter-values problems">
                      <div class="enter-value">Фізичне насильство</div>
                      <div class="enter-value">Міграція, переїзд</div>
                    </div>
                    <div class="ttl">Есть ли у вас психологическое образование</div>
                    <div class="educat" id="ed-choose">
                        <div class="active" onclick="yesEducat()">Есть</div>
                        <div onclick="noEducat()">Учусь</div>
                    </div>
                    <div id="educat_block" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                      <div class="ttl">Добавьте сертефикат</div>
                      <div class="e-block">
                        <input type="file" name="file[]" id="file1" accept="application/pdf">
                        <label for="file1" class="file">Прикрепить</label>
                        <div id="file-display"></div>
                      </div>
                      <div class="e-block">
                        <input type="file" name="file[]" id="file2" accept="application/pdf">
                        <label for="file2" class="file">Прикрепить</label>
                        <div id="file-display"></div>
                      </div>
                      <div class="e-block">
                        <input type="file" name="file[]" id="file3" accept="application/pdf">
                        <label for="file3" class="file">Прикрепить</label>
                        <div id="file-display"></div>
                      </div>
                      <!-- <div class="file1-text">Файл номер 1</div> -->
                    </div>
                    <!-- <div class="ttl">Хотите ли вы быть супервизором?</div>
                    <div class="educat" id="s-wiser">
                        <div class="active" onclick="yesWiser()">Да</div>
                        <div onclick="noWiser()">Нет</div>
                    </div>
                    <div id="super" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                      <div class="ttl">При какой проблеме к вам можно обратиться как к супервизару?</div>
                    <input type="text" name="problem" id="problem" required placeholder="Пережити горе">
                    <div class="enter">Когда заполните - нажмите Enter</div>
                    <div class="enter-values">
                      <div class="enter-value">Фізичне насильство</div>
                      <div class="enter-value">Міграція, переїзд</div>
                    </div>
                    <div class="ttl">Цена за 60 минут</div>
                    <input type="range" name="price" id="price" min="0" max="20000" value="10000" step="1">
                    <div class="range">
                      <div class="range-num">0грн</div>
                      <div class="range-num" style="color: #B1DDCF;">10000грн</div>
                      <div class="range-num">20000грн</div>
                    </div>
                    <div class="ttl">Сколько лет практики</div>
                    <input type="range" name="year" id="year" min="0" max="100" value="50" step="1">
                    <div class="range">
                      <div class="range-num">0</div>
                      <div class="range-num" style="color: #B1DDCF;">50</div>
                      <div class="range-num">100</div>
                    </div>
                    <div class="ttl">Добавьте сертификат супервизора</div>
                    <div class="file1">Прикрепить</div>
                    <div class="file1-text">Файл номер 1</div>
                    </div> -->
                    <input type="submit" value="Отправить заявку">
                    <input style="margin: 0; border: 2px solid rgba(0, 0, 0, 0.15); background: transparent;" type="submit" value="Продолжить верификацию позже">
                    
                    
                </form>
            </div>
          </div>
        </section>
      </main>
      </div>
      <script>

       function addNewFileBlock() {
  var fileInput = document.getElementById(`file`);
  console.log(fileInput.files.length);
  var fileDisplay = document.getElementById(`file-display`);
  fileDisplay.innerHTML = '';
  for (var i = 0; i < fileInput.files.length; i++) {
    var fileName = fileInput.files[i].name;
    var fileType = fileInput.files[i].type;
    if (fileType === 'application/pdf') { // Проверяем, что загруженный файл имеет тип PDF
      var fileURL = URL.createObjectURL(fileInput.files[i]); // Создаем URL для файла
      console.log(`Selected file ${i + 1}:`);
      console.log(`Name: ${fileInput.files[i].name}`);
      
      // Создаем элементы для отображения PDF файла
      var pdfLink = document.createElement('a');
      pdfLink.href = fileURL;
      pdfLink.target = '_blank';
      pdfLink.innerText = fileName;
      
      var pdfIcon = document.createElement('i');
      pdfIcon.classList.add('far', 'fa-file-pdf');
      
      var pdfDiv = document.createElement('div');
      pdfDiv.classList.add('pdf');
      pdfDiv.appendChild(pdfIcon);
      pdfDiv.appendChild(pdfLink);
      
      // Добавляем элементы в блок file-display
      fileDisplay.appendChild(pdfDiv);
    } else {
      alert('Можно загрузить только файлы в формате PDF!');
    }
  }
}
  // var fileName = fileInput.files[0].name;
  // fileDisplay.innerText = fileName;
  
  // if (fileInput && fileDisplay) {
    
  //   k++;
    
  //   // Создаем новый блок "e-block"
  //   var newBlock = document.createElement("div");
  //   newBlock.classList.add("e-block");
  
  //   // Создаем новое поле выбора файла
  //   var newFileInput = document.createElement("input");
  //   newFileInput.type = "file";
  //   newFileInput.name = "file";
  //   newFileInput.id = `file${k}`;
  //   newFileInput.setAttribute("onchange", "addNewFileBlock()");
  
  //   // Создаем новую метку для поля выбора файла
  //   var newLabel = document.createElement("label");
  //   newLabel.classList.add("file");
  //   newLabel.setAttribute("for", `file${k}`);
  //   newLabel.textContent = "Прикрепить";
  
  //   // Создаем новый блок для отображения имени файла
  //   var newDisplay = document.createElement("div");
  //   newDisplay.classList.add(`file-display${k}`);
  
  //   // Добавляем новое поле выбора файла, метку и блок для отображения имени файла в новый блок "e-block"
  //   newBlock.appendChild(newFileInput);
  //   newBlock.appendChild(newLabel);
  //   newBlock.appendChild(newDisplay);
  
  //   // Добавляем новый блок "e-block" в элемент с идентификатором "educat_block"
  //   var educatBlock = document.getElementById("educat_block");
  //   educatBlock.appendChild(newBlock);
  // }


        const form = document.querySelector('form');
        const old = document.getElementById("old");
        const price = document.getElementById("price");
        const year = document.getElementById("year");
        const r_old = document.getElementById("r-old");
        const r_price = document.getElementById("r-price");
        const r_year = document.getElementById("r-year");
        const vector = document.querySelector('input[name="vector"]');
        const vectors = document.querySelector('.vectors');
        const vector_hid = document.getElementById('vector_hid');
        const problem = document.querySelector('input[name="problem"]');
        const problems = document.querySelector('.problems');
        const all_inputs = document.querySelectorAll('input[type=text]');
        r_old.innerHTML = old.value;
        r_price.innerHTML = price.value;
        r_year.innerHTML = year.value;
        old.addEventListener("input", () => {
          r_old.innerHTML = old.value;
        });
        price.addEventListener("input", () => {
          r_price.innerHTML = price.value;
        });
        year.addEventListener("input", () => {
          r_year.innerHTML = year.value;
        });

        all_inputs.forEach(input => {
          input.addEventListener('click', () => {
            input.classList.remove('alert');
          });
        });
        form.addEventListener('submit', function(event) {
          if (!vectors.querySelector('.enter-value') || !problems.querySelector('.enter-value')) {
            event.preventDefault();
            if (!vectors.querySelector('.enter-value')) {
              const firstInput = vector;
              const topOffset = (firstInput.getBoundingClientRect().top + window.scrollY) - 200;
              window.scrollTo({top: topOffset, behavior: 'smooth'});
              firstInput.focus();
              vector.classList.add('alert');
            }
            if (!problems.querySelector('.enter-value')) {
              const firstInput = problem;
              const topOffset = (firstInput.getBoundingClientRect().top + window.scrollY) - 200;
              window.scrollTo({top: topOffset, behavior: 'smooth'});
              firstInput.focus();
              problem.classList.add('alert');
            }
          }
          else {
            const vectorValues = [];
            const vectorDivs = vectors.querySelectorAll('div .enter-value');
            vectorDivs.forEach((div) => {
              vectorValues.push(div.textContent.trim());
            });
            const vectorString = vectorValues.join(';');
            vector_hid.value = vectorString;
          }
        });

        
        vector.addEventListener('keydown', function(event) {
          if (event.key === 'Enter') {
            event.preventDefault();
            const value = this.value.trim();
            if (value) {
              const _div = document.createElement('div');
              _div.classList.add('enter-value');
              _div.textContent = value;
              vectors.appendChild(_div);
              this.value = '';
            }
          }
        });
        problem.addEventListener('keydown', function(event) {
          if (event.key === 'Enter') {
            event.preventDefault();
            const value = this.value.trim();
            if (value) {
              const _div = document.createElement('div');
              _div.classList.add('enter-value');
              _div.textContent = value;
              problems.appendChild(_div);
              this.value = '';
            }
          }
        });
        
        const enterValues = document.querySelectorAll('.enter-values');
        enterValues.forEach((elem) => {
          elem.addEventListener('click', (event) => {
            if (event.target.classList.contains('enter-value')) {
              event.target.remove();
            }
          });
        });
        
        function noWiser() {
          document.getElementById('super').style.display = 'none';
          const inputs = document.querySelectorAll('#super input');
          inputs.forEach(input => {
            input.value = '';
            input.disabled = true;
          });
          const yesOption = document.querySelector('#s-wiser div:nth-child(1)');
          yesOption.classList.remove('active');
          const noOption = document.querySelector('#s-wiser div:nth-child(2)');
          noOption.classList.add('active');
        } 
        function yesWiser() {
          document.getElementById('super').style.display = 'flex';
          const inputs = document.querySelectorAll('#super input');
          inputs.forEach(input => {
            input.disabled = false;
          });
          const yesOption = document.querySelector('#s-wiser div:nth-child(1)');
          yesOption.classList.add('active');
          const noOption = document.querySelector('#s-wiser div:nth-child(2)');
          noOption.classList.remove('active');
        } 
        
        function noEducat() {
          document.getElementById('educat_block').style.display = 'none';
          const inputs = document.querySelectorAll('#educat_block input[type="file"]');
          inputs.forEach(input => {
            input.value = '';
            input.disabled = true;
          });
          const fileDisplay = document.getElementById('file-display');
          fileDisplay.innerHTML = '';
          const yesOption = document.querySelector('#ed-choose div:nth-child(1)');
          yesOption.classList.remove('active');
          const noOption = document.querySelector('#ed-choose div:nth-child(2)');
          noOption.classList.add('active');
        } 
        function yesEducat() {
          document.getElementById('educat_block').style.display = 'flex';
          const inputs = document.querySelectorAll('#educat_block input[type="file"]');
          inputs.forEach(input => {
            input.disabled = false;
          });
          const yesOption = document.querySelector('#ed-choose div:nth-child(1)');
          yesOption.classList.add('active');
          const noOption = document.querySelector('#ed-choose div:nth-child(2)');
          noOption.classList.remove('active');
        } 
      </script>
  </body>
</html>