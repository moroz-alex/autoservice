@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col help mb-5">
                    <h1>Руководство по использованию системы «МойАвтосервис»</h1>
                    <div class="contents">
                        <ul>
                            <li><a href="#description">Описание</a></li>
                            <ul>
                                <li><a href="#features">Особенности</a></li>
                            </ul>
                            <li><a href="#manual">Руководство пользователя</a></li>
                            <ul>
                                <li><a href="#roles">Роли пользователей</a></li>
                                <li><a href="#access">Доступ к системе</a></li>
                                <ul>
                                    <li><a href="#auth">Аутентификация</a></li>
                                    <li><a href="#register">Регистрация нового пользователя</a></li>
                                </ul>
                                <li><a href="#cabinet">Личный кабинет клиента</a></li>
                                <ul>
                                    <li><a href="#client">Раздел «Клиент»</a></li>
                                    <li><a href="#auto">Раздел «Авто»</a></li>
                                    <li><a href="#orders">Раздел «Заказы»</a></li>
                                </ul>
                                <li><a href="#manager">Панель администрирования – менеджер</a></li>
                                <ul>
                                    <li><a href="#manager_orders">Раздел «Заказы»</a></li>
                                    <li><a href="#manager_schedule">Раздел «Расписание»</a></li>
                                    <li><a href="#manager_tasks">Раздел «Работы»</a></li>
                                    <li><a href="#manager_categories">Раздел «Категории работ»</a></li>
                                    <li><a href="#manager_masters">Раздел «Мастера»</a></li>
                                    <li><a href="#manager_clients">Раздел «Клиенты»</a></li>
                                    <li><a href="#manager_autos">Подраздел «Авто» раздела «Клиенты»</a></li>
                                </ul>
                                <li><a href="#admin">Панель администрирования – администратор</a></li>
                                <ul>
                                    <li><a href="#admin_orders">Раздел «Заказы»</a></li>
                                    <li><a href="#admin_schedule">Раздел «Расписание»</a></li>
                                    <li><a href="#admin_tasks">Раздел «Работы»</a></li>
                                    <li><a href="#admin_categories">Раздел «Категории работ»</a></li>
                                    <li><a href="#admin_masters">Раздел «Мастера»</a></li>
                                    <li><a href="#admin_users">Раздел «Пользователи»</a></li>
                                    <li><a href="#admin_models">Раздел «Марки и модели авто»</a></li>
                                    <li><a href="#admin_settings">Раздел «Настройки»</a></li>
                                </ul>
                            </ul>
                        </ul>
                    </div>
                    <h2 id="description">Описание</h2>
                    <p>Система «МойАвтосервис» предназначена для учета заказов и планирования рабочего времени и
                        нагрузки
                        мастеров автосервиса (СТО, шиномонтаж, автомойка и т.д.) с возможностью оформления
                        предварительной
                        записи со стороны клиента.</p>
                    <p>Система имеет клиентский и административный разделы. Доступ к системе осуществляется через
                        веб-браузер по сети интернет.</p>
                    <h3 id="features">Особенности системы</h3>
                    <ul>
                        <li>наглядное расписание загрузки мастеров;</li>
                        <li>выбор и резервирование времени выполнения заказа;</li>
                        <li>распределение заказов в соответствии с загрузкой доступных мастеров;</li>
                        <li>база моделей автомобилей импортируется и обновляется с сайта AUTO RIA;</li>
                        <li>печать заказ-наряда;</li>
                        <li>личный кабинет клиента;</li>
                        <li>«простые» работы доступны для самостоятельного заказа клиентом;</li>
                        <li>уведомления клиентов и менеджеров об изменениях статусов заказов по электронной почте;</li>
                        <li>оценка выполнения заказов клиентом;</li>
                        <li>различные роли пользователей;</li>
                        <li>несколько автомобилей у клиента;</li>
                        <li>редактирование работ, категорий и мастеров;</li>
                        <li>редактирование режима работы организации.</li>
                    </ul>
                    <h2 id="manual">Руководство пользователя</h2>
                    <h3 id="roles">Роли пользователей</h3>
                    <p>Пользователи имеют три уровня доступа к системе в соответствии с ролями: клиент, менеджер и
                        администратор:</p>
                    <ul>
                        <li>клиент – после регистрации на сайте получает доступ к личному кабинету, в котором может
                            просматривать, а также редактировать персональные данные, добавлять и редактировать
                            автомобили,
                            добавлять и редактировать заказы на обслуживание данных автомобилей;
                        </li>
                        <li>менеджер – имеет доступ к административному разделу системы, в котором может просматривать
                            доступные работы, категории работ и мастеров; просматривать, добавлять и редактировать
                            клиентов
                            и их
                            заказы;
                        </li>
                        <li>администратор – имеет доступ к административному разделу системы, в котором имеет полный
                            доступ
                            к
                            просмотру, добавлению, редактированию и удалению работ, категорий работ, мастеров,
                            пользователей,
                            заказов, базы доступных моделей авто и настроек системы.
                        </li>
                    </ul>
                    <h3 id="access">Доступ к системе</h3>
                    <h4 id="auth">Аутентификация</h4>
                    <p>Аутентификация производится на странице входа, доступной с главной страницы сайта, путем ввода
                        электронной почты и пароля пользователя. Доступны функция «запоминания» учетных данных
                        пользователя
                        и функция сброса забытого пароля.</p>
                    <p>В зависимости от установленной роли, после аутентификации пользователь перенаправляется на
                        соответствующий раздел сайта. Пользователь имеет доступ только к тем разделам системы, доступ к
                        которым разрешен в соответствии с установленной ролью пользователя.</p>
                    <h4 id="register">Регистрация нового пользователя</h4>
                    <p>Регистрация производится соответствующей на странице, доступной с главной страницы сайта, путем
                        ввода
                        имени, фамилии, электронной почты, телефона и пароля пользователя. Обязательные для заполнения
                        поля
                        отмечены звездочкой. В системе не может быть зарегистрировано более одного пользователя с
                        идентичными адресами электронной почты или идентичными номерами телефона. Минимальная длина
                        пароля –
                        8 символов.</p>
                    <p>После регистрации для получения доступа к системе пользователю необходимо подтвердить указанный
                        при
                        регистрации адрес электронной почты, воспользовавшись инструкцией в отправленном ему электронном
                        письме. После подтверждения, пользователь будет переадресован в соответствующий его роли раздел
                        сайта.</p>

                    <h3 id="cabinet">Личный кабинет клиента</h3>
                    <p>Личный кабинет пользователя содержит три раздела меню: «Заказы», «Авто» и «Клиент»; а также
                        функцию
                        выхода из системы.</p>
                    <h4 id="client">Раздел «Клиент»</h4>
                    <p>Раздел содержит личные и контактные данные клиента, указанные при регистрации, а также
                        предоставляет
                        доступ к функции их редактирования и функции смены пароля. Для смены пароля пользователю
                        необходимо
                        указать текущий пароль.</p>
                    <h4 id="auto">Раздел «Авто»</h4>
                    <p>Данный раздел содержит информацию об автомобилях клиента, предоставляет доступ к функциям их
                        добавления, редактирования и удаления.</p>
                    <h5>Добавление автомобиля</h5>
                    <p>Клиенту необходимо выбрать нужною модель авто из предоставленного списка. Для удобства поиска
                        можно
                        менять порядок сортировки списка моделей, а также воспользоваться функцией поиска. Также можно
                        указать год выпуска, гос. номер и VIN-код автомобиля.</p>
                    <h5>Редактирование автомобиля</h5>
                    <p>Форма редактирования авто аналогична по внешнему виду и функционалу форме добавления. В случае
                        редактирования автомобиля, на который ранее уже были оформлены заказы, поля «Модель» и «Год
                        выпуска»
                        становятся недоступными для изменения.</p>
                    <h5>Удаление автомобиля</h5>
                    <p>Функция удаления доступна только для автомобилей, на которые ранее не были оформлены заказы.</p>
                    <h4 id="orders">Раздел «Заказы»</h4>
                    <p>Данный раздел содержит перечень заказов клиента и предоставляет доступ к функциям их добавления,
                        просмотра и редактирования.</p>
                    <p>Для самостоятельного заказа клиентом доступны работы, имеющие статус «Доступно для заказа
                        клиентом»
                        (устанавливается администратором). Клиент может единовременно добавить в заказ одну работу. В
                        случае
                        необходимости добавления нескольких работ, необходимо создать несколько заказов или
                        воспользоваться
                        услугами менеджера.</p>
                    <h5>Добавление заказа</h5>
                    <p>Для добавления заказа необходимо нажать кнопку «Добавить заказ», в открывшейся форме выбрать
                        автомобиль из списка добавленных клиентом и работу из списка доступных работ. Для удобства
                        поиска
                        можно менять порядок сортировки, а также воспользоваться функцией поиска, в списках доступных
                        автомобилей и работ. Информация о продолжительности работ, их стоимости и количестве несет
                        информационный характер и изменению клиентом не подлежит.</p>
                    <p>Если нужного автомобиля еще нет в списке, можно нажать кнопку «Добавить автомобиль» формы
                        добавления
                        заказа – таким образом после добавления автомобиля клиент сразу будет переадресован на форму
                        добавления заказа и только что добавленный автомобиль будет выбран автоматически.</p>
                    <p>После выбора авто и работы и нажатия кнопки «Добавить», клиент будет перенаправлен на страницу
                        выбора
                        желаемой даты и времени проведения работ – необходимо выбрать желаемую дату и время из свободных
                        и
                        нажать кнопку «Добавить». Доступные для выбора даты и временные интервалы формируются в
                        соответствии
                        с режимом работы организации (рабочие дни, время работы) и загрузкой мастеров, квалифицированных
                        для
                        выполнения соответствующих работ. Доступны даты на один календарный месяц вперед от текущей
                        даты.
                        Также клиенту недоступна возможность добавления нескольких заказов на одно и то же время для
                        одного
                        и того же автомобиля.</p>
                    <h5>Просмотр заказа</h5>
                    <p>В разделе просмотра заказа отображается подробная информация о заказе: данные автомобиля,
                        подробный
                        перечень работ и использованных деталей, данные менеджера и мастера, дата и время проведения
                        работ,
                        длительность работ и сумма заказа, статус оплаты, статус выполнения заказа, отзыв клиента.</p>
                    <h5>Редактирование заказа</h5>
                    <p>Заказ доступен для редактирования клиентом всех данных, выбранных при его создании, в т.ч. даты и
                        времени работ, только до момента подтверждения менеджером принятия заказа в работу, т.е. пока
                        заказ
                        имеет статус «Новый». В остальных случаях для изменения заказа клиенту необходимо обратиться к
                        менеджеру.</p>
                    <h5>Удаление заказа</h5>
                    <p>Удаление заказов клиентом не предполагается. Клиент может осуществить отмену заказа.</p>
                    <h5>Отмена заказа</h5>
                    <p>Отмена заказа клиентом возможна только до момента подтверждения менеджером принятия заказа в
                        работу,
                        т.е. пока заказ имеет статус «Новый». В остальных случаях для отмены заказа клиенту необходимо
                        обратиться к менеджеру. Кнопка «Отменить заказ» доступна в разделе просмотра заказа.</p>
                    <h5>Отзыв клиента</h5>
                    <p>После выполнения заказа (менеджером установлен статус заказа «Выполнен»), клиент может оценить
                        качество выполнения заказа и оставить отзыв. Кнопка «Добавить отзыв» доступна в разделе
                        просмотра
                        заказа.</p>
                    <h5>Ошибки</h5>
                    <p>В случае, если при добавлении заказа не были выбраны желаемые дата и время работ, либо при
                        возникновении ошибки в расписании, в колонке «Действия» списка заказов отображается
                        иконка-индикатор
                        ошибки в виде календаря красного цвета, по клику на которую клиент может внести правки в
                        расписание.</p>
                    <h5>Уведомления</h5>
                    <p>Клиент получает следующие уведомления на указанную электронную почту:</p>
                    <ul>
                        <li>подтверждение оформления нового заказа;</li>
                        <li>подтверждение заказа менеджером;</li>
                        <li>уведомление об отмене заказа.</li>
                    </ul>

                    <h3 id="manager">Панель администрирования – менеджер</h3>
                    <p>Личный кабинет менеджера содержит следующие разделы: «Заказы», «Расписание», «Работы», «Категории
                        работ», «Мастера» и «Клиенты».</p>
                    <h4 id="manager_orders">Раздел «Заказы»</h4>
                    <p>Данный раздел содержит перечень заказов клиентов и предоставляет доступ к функциям их добавления,
                        просмотра и редактирования.</p>
                    <p>Список заказов поддерживает сортировку по различным критериям, поиск (например, по автомобилю,
                        сумме
                        заказа, статусу, оплате и т.д.) и изменение количества отображаемых на странице заказов.</p>
                    <p>В полях «Показать заказы (с - по)» можно выбрать диапазон дат, в соответствии с которым будет
                        выводиться список заказов. По умолчанию выводится список заказов за последний месяц.</p>
                    <h5>Добавление заказа</h5>
                    <p>Для добавления заказа необходимо нажать кнопку «Добавить заказ», в открывшейся форме выбрать
                        автомобиль из списка ранее добавленных в систему автомобилей клиентов и работу из списка
                        доступных
                        работ. Для удобства поиска можно менять порядок сортировки, а также воспользоваться функцией
                        поиска,
                        в списках доступных автомобилей и работ. Целесообразно осуществлять поиск автомобиля по гос.
                        номеру,
                        телефону или фамилии клиента.</p>
                    <p>Если нужного клиента еще нет в списке, можно нажать кнопку «Добавить клиента» формы добавления
                        заказа
                        – таким образом после добавления клиента автомобиля будет осуществлена переадресация на форму
                        добавления автомобиля данному клиенту, а затем – на форму добавления заказа и только что
                        добавленный
                        автомобиль будет выбран автоматически. Аналогично, при выборе клиента появляется кнопка
                        «Добавить
                        авто клиенту», которую можно использовать для быстрого добавления нового автомобиля выбранному
                        клиенту, с последующей переадресацией на форму добавления заказа.</p>
                    <p>Также в соответствующем разделе в заказ можно добавить используемые детали и материалы.
                        Добавление
                        осуществляется подетально путем нажатия кнопки «+», удаление – нажатием кнопки «х» напротив
                        соответствующей строки.</p>
                    <p>В разделе «Комментарий менеджера» можно оставить заметку к текущему заказу. Комментарий виден
                        только
                        менеджерам и администраторам.</p>
                    <p>Далее, после нажатия кнопки «Добавить», произойдет переадресация на страницу выбора даты, времени
                        проведения работ и мастера, который будет их осуществлять – необходимо выбрать мастера, желаемую
                        дату и время из свободных и нажать кнопку «Добавить». Доступные для выбора даты и временные
                        интервалы формируются в соответствии с режимом работы организации (рабочие дни, время работы) и
                        загрузкой мастеров, квалифицированных для выполнения соответствующих работ. Доступны даты на
                        один
                        календарный месяц вперед от текущей даты.</p>
                    <p>Интервалы, в которые данный автомобиль задействован в другом заказе у другого мастера, помечаются
                        меткой «пересечение». При выборе такого интервала менеджер должен принять решение о возможности
                        выполнения разных работ с одним автомобилем одновременно разными мастерами. <i>Например,
                            электрик
                            может устанавливать сигнализацию в то время, как моторист меняет масло, но шиномонтажник не
                            может менять резину в то время, как осуществляется мойка автомобиля.</i></p>
                    <h5>Просмотр и редактирование заказа</h5>
                    <p>В панели администрирования просмотр и управление заказом осуществляются на одной странице.</p>
                    <p>Для просмотра доступна подробная информация о заказе: данные автомобиля и клиента, подробный
                        перечень
                        работ и использованных деталей, данные менеджера и мастера, дата и время проведения работ,
                        длительность работ и сумма заказа, статус оплаты, статус выполнения заказа, отзыв клиента и
                        комментарий менеджера.</p>
                    <h5>Редактирование авто и клиента</h5>
                    <p>Изменить автомобиль и клиента можно, нажав на кнопку редактирования в разделе «Марка и модель»
                        автомобиля.</p>
                    <h5>Редактирование расписания и мастера</h5>
                    <p>Изменить дату и время проведения работ, а также мастера, можно, нажав на кнопку редактирования в
                        разделе «Начало работ».</p>
                    <p>Для заказов, самостоятельно оформленных клиентами через личный кабинет, мастер выбирается
                        системой
                        автоматически в зависимости от загрузки мастеров в текущий рабочий день (система выбирает
                        мастера с
                        наименьшим количеством загруженных часов в выбранный день, если загрузка среди мастеров
                        одинакова –
                        мастер выбирается случайным образом), поэтому менеджеру целесообразно проверить расписание перед
                        подтверждением заказа и в случае необходимости внести корректировки.</p>
                    <h5>Редактирование перечня работ</h5>
                    <p>Изменить работы можно, нажав на кнопку «Редактировать работы» в разделе «Перечень работ».</p>
                    <h5>Редактирование перечня деталей и материалов</h5>
                    <p>Изменить детали и материалы можно, нажав на кнопку «Редактировать детали» в разделе «Перечень
                        деталей
                        и материалов».</p>
                    <h5>Редактирование комментария менеджера</h5>
                    <p>Изменить комментарий можно в соответствующем поле, после чего необходимо нажать кнопку «Обновить
                        комментарий».</p>
                    <h5>Изменение статуса заказа</h5>
                    <p>Для изменения статуса заказа необходимо выбрать новый статус из выпадающего списка в разделе
                        «Статусы
                        заказа», после чего необходимо нажать кнопку «Обновить статус».</p>
                    <p>После установки статуса «Принят» заказу, оформленному клиентом через личный кабинет,
                        присваивается
                        ответственный менеджер – тот, который установил статус «Применят». На электронную почту клиента
                        отправляется уведомление о подтверждении заказа менеджером.</p>
                    <p>После установки статуса «Выполнен» заказ становится недоступным для редактирования.</p>
                    <p>После установки статуса «Черновик» заказ перестает оказывать влияние на расписание.</p>
                    <p>После установки статуса «Отменен» заказ перестает оказывать влияние на расписание и на
                        электронную
                        почту клиента отправляется уведомление об отмене заказа.</p>
                    <h5>Изменение статуса оплаты заказа</h5>
                    <p>Для изменения статуса оплаты необходимо воспользоваться переключателем в разделе «Оплата
                        заказа.</p>
                    <h5>Печать Заказ-наряда</h5>
                    <p>Для печати заказ-наряда необходимо нажать кнопку «Заказ наряд». В открывшейся форме при
                        необходимости
                        можно изменить дату документа (по умолчанию установлена текущая дата).</p>
                    <h5>Удаление заказа</h5>
                    <p>Удаление заказов менеджером не предполагается. Менеджер может осуществить отмену заказа.</p>
                    <h5>Отмена заказа</h5>
                    <p>Для отмены заказа необходимо установить ему статус «Отменен» в разделе «Статусы заказа».</p>
                    <h5>Ошибки</h5>
                    <p>В случае, если выбраны работы, для выполнения которых требуется более одного мастера, при
                        сохранении
                        заказа будет выведена соответствующая ошибка. В данном случае необходимо разделить заказ на
                        несколько заказов, в соответствии с количеством необходимых для выполнения работ мастеров.</p>
                    <p>В случае, если при добавлении заказа он не был добавлен в расписание, либо при возникновении
                        ошибки в
                        расписании (например, вследствие изменения количества или продолжительности работ в ранее
                        созданном
                        заказа или восстановления ранее отмененного заказа), в колонке «Действия» списка заказов
                        отображается иконка-индикатор ошибки в виде календаря красного цвета, по клику на которую
                        менеджер
                        может внести правки в расписание. Также сигнализатором данной ошибки является красный цвет
                        кнопки
                        редактирования расписания на странице заказа.</p>
                    <h4 id="manager_schedule">Раздел «Расписание»</h4>
                    <p>Раздел в наглядном виде отображает расписание всех доступных мастеров, что позволяет менеджеру
                        оценить их загрузку в течение рабочего дня.</p>
                    <p>В полях «Показать расписание (с - по)» можно выбрать диапазон дат, в соответствии с которым будет
                        выводиться расписание. По умолчанию выводится расписание с текущего дня на месяц вперед.</p>
                    <p>В поле «Дата» осуществляется выбор дня для просмотра расписания.</p>
                    <p>Кнопка «Добавить заказ» позволяет оперативно перейти к добавлению нового заказа.</p>
                    <h4 id="manager_tasks">Раздел «Работы»</h4>
                    <p>Раздел содержит перечень доступных работ. Список поддерживает сортировку по различным критериям,
                        поиск и изменение количества отображаемых на странице работ.</p>
                    <p>Менеджеры не обладают правами для добавления, редактирования или удаления работ.</p>
                    <h4 id="manager_categories">Раздел «Категории работ»</h4>
                    <p>Раздел содержит перечень доступных категорий работ. Список поддерживает сортировку по различным
                        критериям, поиск и изменение количества отображаемых на странице категорий.</p>
                    <p>Менеджеры не обладают правами для добавления, редактирования или удаления категорий.</p>
                    <h4 id="manager_masters">Раздел «Мастера»</h4>
                    <p>Раздел содержит перечень доступных мастеров. Список поддерживает сортировку по различным
                        критериям,
                        поиск и изменение количества отображаемых на странице мастеров.</p>
                    <p>На странице просмотра конкретного мастера отображаются данные мастера и перечень работ, которые
                        он
                        может выполнять.</p>
                    <p>Поле «Доступность» отображает доступность мастера для выполнения текущих заказов. Мастера со
                        статусом
                        «Недоступен» не отображаются при добавлении и редактировании расписания заказа, а также в общем
                        расписании.</p>
                    <p>Менеджеры не обладают правами для добавления, редактирования или удаления мастеров.</p>
                    <h4 id="manager_clients">Раздел «Клиенты»</h4>
                    <p>Раздел содержит перечень зарегистрированных клиентов. Список поддерживает сортировку по различным
                        критериям, поиск и изменение количества отображаемых на странице клиентов.</p>
                    <p>Для добавления нового клиента необходимо нажать кнопку «Добавить клиента». В открывшейся форме
                        необходимо указать имя клиента и номер телефона. Также можно указать адрес электронной почты
                        клиента
                        – в этом случае будет автоматически сгенерирован пароль и клиенту будет отправлено письмо с
                        учетными
                        данными для доступа в личный кабинет. Телефон и адрес электронной почты клиента должны быть
                        уникальными.</p>
                    <p>На странице просмотра конкретного клиента отображаются данные клиента и перечень его заказов.</p>
                    <p>Кнопка «Автомобили» позволяет перейти к списку автомобилей, принадлежащих клиенту. В данном
                        разделе
                        менеджер может просматривать автомобили клиента, добавлять новые и редактировать ранее
                        добавленные.
                        В разделе просмотра конкретного автомобиля есть кнопка для быстрого добавления заказа по данному
                        авто. Менеджеры обладают правами для добавления и редактирования клиентов. Менеджеры не обладают
                        правами для удаления клиентов.</p>
                    <h4 id="manager_autos">Подраздел «Авто» раздела «Клиенты»</h4>
                    <p>Данный раздел содержит информацию об автомобилях клиента, предоставляет доступ к функциям их
                        добавления и редактирования.</p>
                    <h5>Добавление автомобиля</h5>
                    <p>Менеджеру необходимо выбрать нужною модель авто из предоставленного списка. Для удобства поиска
                        можно
                        менять порядок сортировки списка моделей, а также воспользоваться функцией поиска. Также можно
                        указать год выпуска, гос. номер и VIN-код автомобиля.</p>
                    <h5>Редактирование автомобиля</h5>
                    <p>Форма редактирования авто аналогична по внешнему виду и функционалу форме добавления.</p>
                    <h5>Удаление автомобиля</h5>
                    <p>Менеджеры не обладают правами для удаления автомобилей клиента.</p>

                    <h3 id="admin">Панель администрирования – администратор</h3>
                    <p>Личный кабинет администратора содержит те же разделы, что и кабинет менеджера, но с
                        дополнительным
                        функционалом, а также дополнительно разделы «Марки и модели авто» и «Настройки».</p>
                    <h4 id="admin_orders">Раздел «Заказы»</h4>
                    <p>Функционал идентичный <a href="#manager_orders">аналогичному функционалу</a> менеджера.</p>
                    <p>Дополнительный функционал: возможность удаления заказов.</p>
                    <h4 id="admin_schedule">Раздел «Расписание»</h4>
                    <p>Функционал идентичный <a href="#manager_schedule">аналогичному функционалу</a> менеджера.</p>
                    <h4 id="admin_tasks">Раздел «Работы»</h4>
                    <p>Функционал идентичный <a href="#manager_tasks">аналогичному функционалу</a> менеджера.</p>
                    <p>Дополнительный функционал: возможность добавления, редактирования и удаления работ.</p>
                    <h5>Добавление и редактирование работы</h5>
                    <p>Обязательные поля отмечены звездочкой. Переключатель «Доступно для самостоятельного заказа
                        клиентом»
                        позволяет изменять доступность данной работы к заказу из личного кабинета клиента. Делать
                        доступными
                        для клиента рекомендуется простые и универсальные работы, не предполагающие предварительной
                        оценки
                        сложности и объема менеджером или мастером.</p>
                    <h5>Удаление работы</h5>
                    <p>Администраторы обладают правами для удаления работ. Невозможно удаление работ, на которые уже
                        были
                        оформлены заказы.</p>
                    <h4 id="admin_categories">Раздел «Категории работ»</h4>
                    <p>Функционал идентичный <a href="#manager_categories">аналогичному функционалу</a> менеджера.</p>
                    <p>Дополнительный функционал: возможность добавления, редактирования и удаления категорий работ.</p>
                    <p>На странице просмотра конкретной категории отображается перечень входящих в нее работ, с
                        возможностью
                        добавления и редактирования.</p>
                    <h5>Добавление и редактирование категорий работ</h5>
                    <p>Форма содержит единственное поле – «Название».</p>
                    <h5>Удаление категории работ</h5>
                    <p>Администраторы обладают правами для удаления категорий работ. Невозможно удаление категорий
                        работ,
                        которые содержат в себе работы.</p>
                    <h4 id="admin_masters">Раздел «Мастера»</h4>
                    <p>Функционал идентичный <a href="#manager_masters">аналогичному функционалу</a> менеджера.</p>
                    <p>Дополнительный функционал: возможность добавления, редактирования и удаления мастеров.</p>
                    <h5>Добавление и редактирование мастеров</h5>
                    <p>В форме необходимо указать данные мастера, а также выбрать выполняемые им работы. Для удобства
                        поиска
                        можно менять порядок сортировки списка работ, а также воспользоваться функцией поиска.</p>
                    <p>Переключатель «Мастер доступен» позволяет убирать мастера из перечня доступных в расписании на
                        время
                        отпуска или в случае увольнения. История выполненных мастером заказов при этом сохраняется.</p>
                    <h5>Удаление мастеров</h5>
                    <p>Администраторы обладают правами для удаления мастеров. Невозможно удаление мастеров, которые
                        ранее
                        уже были задействованы в заказах.</p>
                    <h4 id="admin_users">Раздел «Пользователи»</h4>
                    <p>Функционал идентичный функционалу раздела «Клиенты» менеджера.</p>
                    <p>Дополнительный функционал: возможность удаления пользователей и изменения ролей пользователей
                        («Клиент», «Менеджер» или «Администратор»). Также, помимо клиентов, перечень пользователей
                        включает
                        менеджеров и администраторов.</p>
                    <h5>Добавление и редактирование пользователей</h5>
                    <p>Процедура аналогична добавлению клиента в кабинете менеджера. Отличие – необходимость указания
                        роли
                        пользователя.</p>
                    <h5>Удаление пользователей</h5>
                    <p>Администраторы обладают правами для удаления пользователей. Невозможно удаление пользователей, у
                        которых добавлены автомобили или созданы заказы.</p>
                    <h4 id="admin_models">Раздел «Марки и модели авто»</h4>
                    <p>Раздел содержит перечень марок автомобилей, доступных для добавления клиентам.</p>
                    <p>На странице просмотра конкретной марки отображается перечень входящих в нее моделей
                        автомобилей.</p>
                    <h5>Обновление марок и моделей автомобилей</h5>
                    <p>Для обновления необходимо нажать кнопку «Обновить список всех марок и моделей». Обновление
                        происходит
                        по API с сайта AUTO RIA в фоновом режиме. Для возможности обновления необходимо указать API ключ
                        сервиса AUTO RIA в разделе «Настройки».</p>
                    <h4 id="admin_settings">Раздел «Настройки»</h4>
                    <p>Поля «Название организации», «Адрес» и «Телефон(ы)» используются для вывода реквизитов
                        организации в
                        разделе «Контакты», а также для их печати в заказ-нарядах.</p>
                    <p>В поле «Email» необходимо указать адрес электронной почты организации, на который будут приходить
                        уведомления о заказах и изменениях их статусов.</p>
                    <p>В полях «Рабочие дни» и «Время работы» необходимо указать график работы организации. В
                        соответствии в
                        этими данными будет формироваться расписание мастеров.</p>
                    <p>В поле «API ключ сервиса AUTO RIA» необходимо указать ключ для обновления базы марок и моделей
                        автомобилей.</p>
                </div>
            </div>
        </div>
    </main>
@endsection
