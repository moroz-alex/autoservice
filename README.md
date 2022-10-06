# Руководство по использованию системы «МойАвтосервис»

Демонстрационная версия системы: [myautoservice.alwaysdata.net](http://myautoservice.alwaysdata.net)

Демонстрационные учетные данные:

- интерфейс клиента: логин - client@client, пароль - 123123123
- интерфейс менеджера: логин - manager@manager, пароль - 123123123
- интерфейс администратора: логин - admin@admin, пароль - 123123123

Оглавление

- [Описание системы](#Описание)
    - [Особенности](#Особенности-системы)
- [Руководство пользователя](#Руководство-пользователя)
    - [Роли пользователей](#Роли-пользователей)
    - [Первичная настройка](#Первичная-настройка)
    - [Доступ к системе](#Доступ-к-системе)
        - [Аутентификация](#Аутентификация)
        - [Регистрация нового пользователя](#Регистрация-нового-пользователя)
    - [Личный кабинет клиента](#Личный-кабинет-клиента)
        - [Раздел «Клиент»](#Раздел-Клиент)
        - [Раздел «Авто»](#Раздел-Авто)
        - [Раздел «Заказы»](#Раздел-Заказы)
    - [Панель администрирования – менеджер](#Панель-администрирования--менеджер)
        - [Раздел «Заказы»](#Раздел-Заказы-1)
        - [Раздел «Расписание»](#Раздел-Расписание)
        - [Раздел «Работы»](#Раздел-Работы)
        - [Раздел «Категории работ»](#Раздел-Категории-работ)
        - [Раздел «Мастера»](#Раздел-Мастера)
        - [Раздел «Клиенты»](#Раздел-Клиенты)
        - [Подраздел «Авто» раздела «Клиенты»](#Подраздел-Авто-раздела-Клиенты)
    - [Панель администрирования – администратор](#Панель-администрирования--администратор)
        - [Раздел «Заказы»](#Раздел-Заказы-2)
        - [Раздел «Расписание»](#Раздел-Расписание-1)
        - [Раздел «Работы»](#Раздел-Работы-1)
        - [Раздел «Категории работ»](#Раздел-Категории-работ-1)
        - [Раздел «Мастера»](#Раздел-Мастера-1)
        - [Раздел «Пользователи»](#Раздел-Пользователи)
        - [Раздел «Марки и модели авто»](#Раздел-Марки-и-модели-авто)
        - [Раздел «Настройки»](#Раздел-Настройки)

## Описание

<p>Система «МойАвтосервис» предназначена для учета заказов и планирования рабочего времени и
    нагрузки
    мастеров автосервиса (СТО, шиномонтаж, автомойка и т.д.) с возможностью оформления
    предварительной
    записи со стороны клиента.</p>
<p>Система имеет клиентский и административный разделы. Доступ к системе осуществляется через
    веб-браузер по сети интернет.</p>

### Особенности системы

- наглядное расписание загрузки мастеров;
- выбор и резервирование времени выполнения заказа;
- распределение заказов в соответствии с загрузкой доступных мастеров;
- база моделей автомобилей импортируется и обновляется с сайта AUTO RIA;
- печать заказ-наряда;
- личный кабинет клиента;
- «простые» работы доступны для самостоятельного заказа клиентом;
- уведомления клиентов и менеджеров об изменениях статусов заказов по электронной почте;
- оценка выполнения заказов клиентом;
- различные роли пользователей;
- несколько автомобилей у клиента;
- редактирование работ, категорий и мастеров;
- редактирование режима работы организации.

## Руководство пользователя

### Первичная настройка

<p>После установки неоходимо зарегистрироваться на developers.ria.com и получить API ключ для
возможности загрузки и обновления базы марок и моделей автомобилей. Ключ нужно вставить в поле 
"API ключ сервиса AUTO RIA" в разделе "Настройки". Затем в разделе "Марки и модели авто" нажмите 
кнопку "Обновить список всех марок и моделей" - будут импортированы марки и модели автомобилей 
(процесс реализован с использованием очередей, подождите несколько минут). 
</p>

### Роли пользователей

<p>Пользователи имеют три уровня доступа к системе в соответствии с ролями: клиент, менеджер и
    администратор:</p>

- клиент – после регистрации на сайте получает доступ к личному кабинету, в котором может просматривать, а также
  редактировать персональные данные, добавлять и редактировать автомобили, добавлять и редактировать заказы на
  обслуживание данных автомобилей;
- менеджер – имеет доступ к административному разделу системы, в котором может просматривать доступные работы, категории
  работ и мастеров; просматривать, добавлять и редактировать клиентов и их заказы;
- администратор – имеет доступ к административному разделу системы, в котором имеет полный доступ к просмотру,
  добавлению, редактированию и удалению работ, категорий работ, мастеров, пользователей, заказов, базы доступных моделей
  авто и настроек системы.

### Доступ к системе

#### Аутентификация

<p>Аутентификация производится на странице входа, доступной с главной страницы сайта, путем ввода
    электронной почты и пароля пользователя. Доступны функция «запоминания» учетных данных
    пользователя
    и функция сброса забытого пароля.</p>
<p>В зависимости от установленной роли, после аутентификации пользователь перенаправляется на
    соответствующий раздел сайта. Пользователь имеет доступ только к тем разделам системы, доступ к
    которым разрешен в соответствии с установленной ролью пользователя.</p>

#### Регистрация нового пользователя

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

### Личный кабинет клиента

<p>Личный кабинет пользователя содержит три раздела меню: «Заказы», «Авто» и «Клиент»; а также
    функцию
    выхода из системы.</p>

#### Раздел «Клиент»

<p>Раздел содержит личные и контактные данные клиента, указанные при регистрации, а также
    предоставляет
    доступ к функции их редактирования и функции смены пароля. Для смены пароля пользователю
    необходимо
    указать текущий пароль.</p>

#### Раздел «Авто»

<p>Данный раздел содержит информацию об автомобилях клиента, предоставляет доступ к функциям их
    добавления, редактирования и удаления.</p>

##### Добавление автомобиля

<p>Клиенту необходимо выбрать нужною модель авто из предоставленного списка. Для удобства поиска
    можно
    менять порядок сортировки списка моделей, а также воспользоваться функцией поиска. Также можно
    указать год выпуска, гос. номер и VIN-код автомобиля.</p>

##### Редактирование автомобиля

<p>Форма редактирования авто аналогична по внешнему виду и функционалу форме добавления. В случае
    редактирования автомобиля, на который ранее уже были оформлены заказы, поля «Модель» и «Год
    выпуска»
    становятся недоступными для изменения.</p>

##### Удаление автомобиля

<p>Функция удаления доступна только для автомобилей, на которые ранее не были оформлены заказы.</p>

#### Раздел «Заказы»

<p>Данный раздел содержит перечень заказов клиента и предоставляет доступ к функциям их добавления,
    просмотра и редактирования.</p>
<p>Для самостоятельного заказа клиентом доступны работы, имеющие статус «Доступно для заказа
    клиентом»
    (устанавливается администратором). Клиент может единовременно добавить в заказ одну работу. В
    случае
    необходимости добавления нескольких работ, необходимо создать несколько заказов или
    воспользоваться
    услугами менеджера.</p>

##### Добавление заказа

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

##### Просмотр заказа

<p>В разделе просмотра заказа отображается подробная информация о заказе: данные автомобиля,
    подробный
    перечень работ и использованных деталей, данные менеджера и мастера, дата и время проведения
    работ,
    длительность работ и сумма заказа, статус оплаты, статус выполнения заказа, отзыв клиента.</p>

##### Редактирование заказа

<p>Заказ доступен для редактирования клиентом всех данных, выбранных при его создании, в т.ч. даты и
    времени работ, только до момента подтверждения менеджером принятия заказа в работу, т.е. пока
    заказ
    имеет статус «Новый». В остальных случаях для изменения заказа клиенту необходимо обратиться к
    менеджеру.</p>

##### Удаление заказа

<p>Удаление заказов клиентом не предполагается. Клиент может осуществить отмену заказа.</p>

##### Отмена заказа

<p>Отмена заказа клиентом возможна только до момента подтверждения менеджером принятия заказа в
    работу,
    т.е. пока заказ имеет статус «Новый». В остальных случаях для отмены заказа клиенту необходимо
    обратиться к менеджеру. Кнопка «Отменить заказ» доступна в разделе просмотра заказа.</p>

##### Отзыв клиента

<p>После выполнения заказа (менеджером установлен статус заказа «Выполнен»), клиент может оценить
    качество выполнения заказа и оставить отзыв. Кнопка «Добавить отзыв» доступна в разделе
    просмотра
    заказа.</p>

##### Ошибки

<p>В случае, если при добавлении заказа не были выбраны желаемые дата и время работ, либо при
    возникновении ошибки в расписании, в колонке «Действия» списка заказов отображается
    иконка-индикатор
    ошибки в виде календаря красного цвета, по клику на которую клиент может внести правки в
    расписание.</p>

##### Уведомления

<p>Клиент получает следующие уведомления на указанную электронную почту:</p>

- подтверждение оформления нового заказа;
- подтверждение заказа менеджером;
- уведомление об отмене заказа.

### Панель администрирования – менеджер

<p>Личный кабинет менеджера содержит следующие разделы: «Заказы», «Расписание», «Работы», «Категории
    работ», «Мастера» и «Клиенты».</p>

#### Раздел «Заказы»

<p>Данный раздел содержит перечень заказов клиентов и предоставляет доступ к функциям их добавления,
    просмотра и редактирования.</p>
<p>Список заказов поддерживает сортировку по различным критериям, поиск (например, по автомобилю,
    сумме
    заказа, статусу, оплате и т.д.) и изменение количества отображаемых на странице заказов.</p>
<p>В полях «Показать заказы (с - по)» можно выбрать диапазон дат, в соответствии с которым будет
    выводиться список заказов. По умолчанию выводится список заказов за последний месяц.</p>

##### Добавление заказа

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

##### Просмотр и редактирование заказа

<p>В панели администрирования просмотр и управление заказом осуществляются на одной странице.</p>
<p>Для просмотра доступна подробная информация о заказе: данные автомобиля и клиента, подробный
    перечень
    работ и использованных деталей, данные менеджера и мастера, дата и время проведения работ,
    длительность работ и сумма заказа, статус оплаты, статус выполнения заказа, отзыв клиента и
    комментарий менеджера.</p>

##### Редактирование авто и клиента

<p>Изменить автомобиль и клиента можно, нажав на кнопку редактирования в разделе «Марка и модель»
    автомобиля.</p>

##### Редактирование расписания и мастера

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

##### Редактирование перечня работ

<p>Изменить работы можно, нажав на кнопку «Редактировать работы» в разделе «Перечень работ».</p>

##### Редактирование перечня деталей и материалов

<p>Изменить детали и материалы можно, нажав на кнопку «Редактировать детали» в разделе «Перечень
    деталей
    и материалов».</p>

##### Редактирование комментария менеджера

<p>Изменить комментарий можно в соответствующем поле, после чего необходимо нажать кнопку «Обновить
    комментарий».</p>

##### Изменение статуса заказа

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

##### Изменение статуса оплаты заказа

<p>Для изменения статуса оплаты необходимо воспользоваться переключателем в разделе «Оплата
    заказа.</p>

##### Печать Заказ-наряда

<p>Для печати заказ-наряда необходимо нажать кнопку «Заказ наряд». В открывшейся форме при
    необходимости
    можно изменить дату документа (по умолчанию установлена текущая дата).</p>

##### Удаление заказа

<p>Удаление заказов менеджером не предполагается. Менеджер может осуществить отмену заказа.</p>

##### Отмена заказа

<p>Для отмены заказа необходимо установить ему статус «Отменен» в разделе «Статусы заказа».</p>

##### Ошибки

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

#### Раздел «Расписание»

<p>Раздел в наглядном виде отображает расписание всех доступных мастеров, что позволяет менеджеру
    оценить их загрузку в течение рабочего дня.</p>
<p>В полях «Показать расписание (с - по)» можно выбрать диапазон дат, в соответствии с которым будет
    выводиться расписание. По умолчанию выводится расписание с текущего дня на месяц вперед.</p>
<p>В поле «Дата» осуществляется выбор дня для просмотра расписания.</p>
<p>Кнопка «Добавить заказ» позволяет оперативно перейти к добавлению нового заказа.</p>

#### Раздел «Работы»

<p>Раздел содержит перечень доступных работ. Список поддерживает сортировку по различным критериям,
    поиск и изменение количества отображаемых на странице работ.</p>
<p>Менеджеры не обладают правами для добавления, редактирования или удаления работ.</p>

#### Раздел «Категории работ»

<p>Раздел содержит перечень доступных категорий работ. Список поддерживает сортировку по различным
    критериям, поиск и изменение количества отображаемых на странице категорий.</p>
<p>Менеджеры не обладают правами для добавления, редактирования или удаления категорий.</p>

#### Раздел «Мастера»

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

#### Раздел «Клиенты»

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

#### Подраздел «Авто» раздела «Клиенты»

<p>Данный раздел содержит информацию об автомобилях клиента, предоставляет доступ к функциям их
    добавления и редактирования.</p>

##### Добавление автомобиля

<p>Менеджеру необходимо выбрать нужною модель авто из предоставленного списка. Для удобства поиска
    можно
    менять порядок сортировки списка моделей, а также воспользоваться функцией поиска. Также можно
    указать год выпуска, гос. номер и VIN-код автомобиля.</p>

##### Редактирование автомобиля

<p>Форма редактирования авто аналогична по внешнему виду и функционалу форме добавления.</p>

##### Удаление автомобиля

<p>Менеджеры не обладают правами для удаления автомобилей клиента.</p>

### Панель администрирования – администратор

<p>Личный кабинет администратора содержит те же разделы, что и кабинет менеджера, но с
    дополнительным
    функционалом, а также дополнительно разделы «Марки и модели авто» и «Настройки».</p>

#### Раздел «Заказы»

<p>Функционал идентичный аналогичному функционалу менеджера.</p>
<p>Дополнительный функционал: возможность удаления заказов.</p>

#### Раздел «Расписание»

<p>Функционал идентичный аналогичному функционалу менеджера.</p>

#### Раздел «Работы»

<p>Функционал идентичный аналогичному функционалу менеджера.</p>
<p>Дополнительный функционал: возможность добавления, редактирования и удаления работ.</p>

##### Добавление и редактирование работы

<p>Обязательные поля отмечены звездочкой. Переключатель «Доступно для самостоятельного заказа
    клиентом»
    позволяет изменять доступность данной работы к заказу из личного кабинета клиента. Делать
    доступными
    для клиента рекомендуется простые и универсальные работы, не предполагающие предварительной
    оценки
    сложности и объема менеджером или мастером.</p>

##### Удаление работы

<p>Администраторы обладают правами для удаления работ. Невозможно удаление работ, на которые уже
    были
    оформлены заказы.</p>

#### Раздел «Категории работ»

<p>Функционал идентичный аналогичному функционалу менеджера.</p>
<p>Дополнительный функционал: возможность добавления, редактирования и удаления категорий работ.</p>
<p>На странице просмотра конкретной категории отображается перечень входящих в нее работ, с
    возможностью
    добавления и редактирования.</p>

##### Добавление и редактирование категорий работ

<p>Форма содержит единственное поле – «Название».</p>

##### Удаление категории работ

<p>Администраторы обладают правами для удаления категорий работ. Невозможно удаление категорий
    работ,
    которые содержат в себе работы.</p>

#### Раздел «Мастера»

<p>Функционал идентичный аналогичному функционалу менеджера.</p>
<p>Дополнительный функционал: возможность добавления, редактирования и удаления мастеров.</p>

##### Добавление и редактирование мастеров

<p>В форме необходимо указать данные мастера, а также выбрать выполняемые им работы. Для удобства
    поиска
    можно менять порядок сортировки списка работ, а также воспользоваться функцией поиска.</p>
<p>Переключатель «Мастер доступен» позволяет убирать мастера из перечня доступных в расписании на
    время
    отпуска или в случае увольнения. История выполненных мастером заказов при этом сохраняется.</p>

##### Удаление мастеров

<p>Администраторы обладают правами для удаления мастеров. Невозможно удаление мастеров, которые
    ранее
    уже были задействованы в заказах.</p>

#### Раздел «Пользователи»

<p>Функционал идентичный функционалу раздела «Клиенты» менеджера.</p>
<p>Дополнительный функционал: возможность удаления пользователей и изменения ролей пользователей
    («Клиент», «Менеджер» или «Администратор»). Также, помимо клиентов, перечень пользователей
    включает
    менеджеров и администраторов.</p>

##### Добавление и редактирование пользователей

<p>Процедура аналогична добавлению клиента в кабинете менеджера. Отличие – необходимость указания
    роли
    пользователя.</p>

##### Удаление пользователей

<p>Администраторы обладают правами для удаления пользователей. Невозможно удаление пользователей, у
    которых добавлены автомобили или созданы заказы.</p>

#### Раздел «Марки и модели авто»

<p>Раздел содержит перечень марок автомобилей, доступных для добавления клиентам.</p>
<p>На странице просмотра конкретной марки отображается перечень входящих в нее моделей
    автомобилей.</p>

##### Обновление марок и моделей автомобилей

<p>Для обновления необходимо нажать кнопку «Обновить список всех марок и моделей». Обновление
    происходит
    по API с сайта AUTO RIA в фоновом режиме. Для возможности обновления необходимо указать API ключ
    сервиса AUTO RIA в разделе «Настройки».</p>

#### Раздел «Настройки»

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
