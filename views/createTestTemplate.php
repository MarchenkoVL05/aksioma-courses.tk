<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Шрифты -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Мои стили -->
    <link href="../style.css" rel="stylesheet">
    <title>Создание теста</title>
</head>
<body>
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="javascript:window.history.back()"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <h1 class="add-lesson-title"><img class="add-lesson-title__img" src="../images/stationery.png" alt="Создать урок"> Создание вопроса</h1>
        <form class="add-test-form" method="POST" action="../index.php?action=<?=$_GET['action']?>">
            <!-- Вопрос -->
            <div class="test-input-title">Введите сам вопрос</div>
            <input name="q-name" class="test-input test-input--mb" type="text" placeholder="Со знаком вопроса, если нужно" required></input>
            <!-- Курс -->
            <div class="test-input-title">Выберите курс</div>
            <div class="select">
                <select id="select1" class="test-select">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?=$category['id']?>"><?=$category["category_name"]?></option>
                    <?php endforeach?>
                </select>
                <div class="select_arrow"></div>
            </div>
            <!-- Урок -->
            <div class="test-input-title">Выберите урок</div>
            <div class="select">
                <select id="select2" class="test-select" name="q-lesson_id" required>
                    <option value="">Сначала выберите курс</option>
                </select>
                <div class="select_arrow"></div>
            </div>
            <!-- Тип вопроса -->
            <div class="test-input-title">Тип вопроса</div>
            <div class="select select-answers">
                <select id="select3" class="test-select" name="q-lesson_type" required>
                    <option value="radio">Выбрать один правильный ответ</option>
                    <option value="checkbox">Выбрать несколько правильных ответов</option>
                    <option value="text">Вписать ответ</option>
                </select>
                <div class="select_arrow"></div>
            </div>
            <!-- варианты ответа -->
            <div class="test-input-title test-input-title--hide">Варианты ответа</div>
            <div class="inputs-answers-wrapper">
                <input name="answer1" class="test-input test-input--mb test-input-required" type="text" placeholder="Ответ" required>
                <input name="answer2" class="test-input test-input--mb test-input-required" type="text" placeholder="Ответ" required>
                <input name="answer3" class="test-input test-input--mb test-input-required" type="text" placeholder="Ответ">
            </div>
            <button class="btn-add-answer">Добавить вариант &#8595;</button>
            <!-- Правильный ответ -->
            <div class="test-input-title test-input-title--hide">Правильный ответ</div>
            <div class="inputs-answers-wrapper--right">
                <input name="q-right1" class="test-input test-input--mb test-input-required" type="text" placeholder="Скопируйте вариант" required></input>
            </div>
            <button class="btn-add-answer btn-add-answer--right">Добавить правильный ответ &#8595;</button>
            <!-- Отправить -->
            <input onclick="tinyMCE.triggerSave(true,true);" class="add-test-save add-lesson-save" type="submit" value="Сохранить">
        </form>
    </div>
    <script>
        let select1 = document.getElementById("select1");
        let select2 = document.getElementById("select2");

        select1.addEventListener("change", async (e) => {
            var formData = new FormData();
            formData.append('category', e.target.value);
            await fetch("getLessonsForTest.php", {
                method: "POST",
                body: formData,
            })
            .then((response) => response.json())
            .then((result) => {
                console.log(result);
                changeSelect(result);
            });
        });

        function changeSelect(options) {
            select2.innerHTML = '';
            options.map((option) => {
                let optionNode = document.createElement("option");
                optionNode.value = option.id;
                optionNode.name = option.id;
                optionNode.text = option.title;
                select2.appendChild(optionNode);
            });
        }

        // Добавлять ответы
        let addAnswerBtn = document.querySelector(".btn-add-answer");
        let inputAnswersWrapper = document.querySelector(".inputs-answers-wrapper");

        questionNumber = 4;
        addAnswerBtn.addEventListener("click", (e) => {
            e.preventDefault();
            if (questionNumber <= 10) {
                let input = document.createElement("input");
                input.name = `answer${questionNumber++}`;
                input.className = "test-input test-input--mb";
                input.placeholder = "Ответ";
                inputAnswersWrapper.append(input);
            }
        });

        // Добавить правильный ответ
        let addRightAnswerBtn = document.querySelector(".btn-add-answer--right");
        let inputRightAnswersWrapper = document.querySelector(".inputs-answers-wrapper--right");

        rightAnswerNumber = 2;
        addRightAnswerBtn.addEventListener("click", (e) => {
            e.preventDefault();
            if (rightAnswerNumber <= 10) {
                let input = document.createElement("input");
                input.name = `q-right${rightAnswerNumber++}`;
                input.className = "test-input test-input--mb";
                input.placeholder = "Скопируйте вариант";
                inputRightAnswersWrapper.append(input);
            }
        });

        // Убрать поля с вариантами и ответами, если тип вопроса - текст
        select3.addEventListener("change", (e) => {
            let testInputTitle = document.querySelectorAll(".test-input-title--hide");
            let testInputsAnswersWrapper = document.querySelector(".inputs-answers-wrapper");
            let inputsAnswerWrapperRight = document.querySelector(".inputs-answers-wrapper--right");
            let btnAddAnswer = document.querySelectorAll(".btn-add-answer");
            let requiredFileds = document.querySelectorAll(".test-input-required");

            if (e.target.value == 'text') {
                testInputTitle.forEach((item) => {
                    item.style.display = "none";
                });
                testInputsAnswersWrapper.style.display = "none";
                inputsAnswerWrapperRight.style.display = "none";
                btnAddAnswer.forEach((item) => {
                    item.style.display = "none";
                });

                requiredFileds.forEach((item) => {
                    item.removeAttribute("required");
                });
            } else {
                testInputTitle.forEach((item) => {
                    item.style.display = "block";
                });
                testInputsAnswersWrapper.style.display = "block";
                inputsAnswerWrapperRight.style.display = "block";
                btnAddAnswer.forEach((item) => {
                    item.style.display = "flex";
                });
                requiredFileds.forEach((item) => {
                    item.setAttribute("required");
                });
            }
        });
    </script>
</body>
</html>