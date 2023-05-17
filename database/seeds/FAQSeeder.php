<?php

use App\Models\Home\FAQ\{Category, Question};
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $categoryIdsByKey = [
            'popular' => 1,
            'blogtime' => 2,
            'business_pack' => 3,
            'business_gaming' => 4,
            'affiliate_program' => 5,
            'education' => 6,
            'investments' => 7,
            'graybull' => 8,
        ];

        $categoryRows = Category::insertOrIgnore([
            [
                'id' => $categoryIdsByKey['popular'],
                'name' => json_encode([
                    'ru' => 'Популярное',
                    'en' => 'Popular',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => $categoryIdsByKey['blogtime'],
                'name' => json_encode([
                    'ru' => 'Blogtime',
                    'en' => 'Blogtime',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => $categoryIdsByKey['business_pack'],
                'name' => json_encode([
                    'ru' => 'Business pack',
                    'en' => 'Business pack',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => $categoryIdsByKey['business_gaming'],
                'name' => json_encode([
                    'ru' => 'Business gaming',
                    'en' => 'Business gaming',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => $categoryIdsByKey['affiliate_program'],
                'name' => json_encode([
                    'ru' => 'Партнерская программа',
                    'en' => 'Affiliate program',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => $categoryIdsByKey['education'],
                'name' => json_encode([
                    'ru' => 'Образование',
                    'en' => 'Education',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => $categoryIdsByKey['investments'],
                'name' => json_encode([
                    'ru' => 'Инвестиции',
                    'en' => 'Investments',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => $categoryIdsByKey['graybull'],
                'name' => json_encode([
                    'ru' => 'Graybull',
                    'en' => 'Graybull',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $questionRows = Question::insertOrIgnore([
            [
                'id' => 1,
                'name' => json_encode([
                    'ru' => 'Чем занимается ваша компания?',
                    'en' => 'What does your company do?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Компания предлагает различный IT-услуги и продукты собственной реализации широкой аудитории посредством MLM. Стремительно масштабирование компании основано на привлечениях инвестиций и следовании бизнес-модели IT+MLM+Invest',
                    'en' => 'The Company offers various IT services and products of its own implementation to a wide audience through MLM. Rapidly scaling the company is based on attracting investment and following the business model of IT + MLM+Invest',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => json_encode([
                    'ru' => 'Какая идея компании?',
                    'en' => 'What\'s the company\'s idea?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Dinway — это социальный проект, призванный покрыть базовые потребности каждого пользователя, реализовать их планы на жилье, авто, закрытие кредитов, ремонт или путешествие, вывести партнёров на новый финансовый и личностный уровень и, в конце концов, наша миссия  — построить новое гармоничное общество с собственной финансовой и образовательной системой.',
                    'en' => 'Dinway is a social project designed to cover the basic needs of each user, implement their plans for housing, cars, closing loans, repairs or travel, bring partners to a new financial and personal level and, in the end, our mission is to build a new harmonious society with its own financial and educational system.',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => json_encode([
                    'ru' => 'Какие услуги и продукты предлагает Dinway?',
                    'en' => 'What services and products does Dinway offer?',
                ]),
                'answer' => json_encode([
                    'ru' => '
                Dinway предлагает услуги и продукты для разных аудиторий, тем самым делая сообщество более обширным и вовлеченным. Продукт по душе найдут для себя крупные и мелкие инвесторы, сетевые лидеры и начинающие специалисты по продажам,  стартапы и успешный бизнес, начинающие и профессиональные блогеры, игроманы и специалисты в трейдинге, студенты, люди желающие сменить профессию или те, кто ищут своё дело. Каждый житель Земли сможет найти продукт для себя, так как мы каждый месяц добавляем что-то новое. На текущий момент список продуктов следующий:
                    <ul class="question-list">
                        <li>Инвестиционная программа;</li>
                        <li>Партнёрская программа;</li>
                        <li>Business Gaming — заработок на играх;</li>
                        <li>Business Pack — упаковка и масштабирование вашего бизнеса;</li>
                        <li>Blog Time — продюсерский центр для блогеров;</li>
                        <li>Profi Universe — образовательная программа.</li>
                    </ul>
                ',
                    'en' => '
                Dinway offers services and products for different audiences, thereby making the community more extensive and engaged. The product will appeal to large and small investors, network leaders and novice sales professionals, startups and successful businesses, beginners and professional bloggers, gamblers and specialists in trading, students, people who want to change their profession or those who are looking for their own business. Every inhabitant of the earth will be able to find a product for themselves, as we add something new every month. At the moment, the list of products is as follows:
                    <ul class="question-list">
                        <li>Investment program;</li>
                        <li>Affiliate program;</li>
                        <li>Business Gaming — making money from games;</li>
                        <li>Business Pack and scaling your business;</li>
                        <li>Blog Time-production center for bloggers;</li>
                        <li>Profi Universe - educational program.</li>
                    </ul>
                ',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => json_encode([
                    'ru' => 'Что означает название Dinway?',
                    'en' => 'What does the name Dinway mean?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Din — имя жирафа, символа нашей компании, а way — с англ. путь.',
                    'en' => 'Din is the name of the giraffe, the symbol of our company, and way is the English way.',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => json_encode([
                    'ru' => 'Почему символом компании стал жираф?',
                    'en' => 'Why did the giraffe become the company\'s symbol?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Жираф — символ дальновидности, интеллекта; хороший талисман для ученых, политиков, творческих людей, а также для детей и студентов. Жираф — один из древнейших символов счастья, удачи и благосостояния. Жираф символизирует желание и способность дотянуться до чего-то далекого, неизведанного, тяга к желаемому.',
                    'en' => 'Giraffe-a symbol of foresight, intelligence; a good talisman for scientists, politicians, creative people, as well as for children and students. The giraffe is one of the oldest symbols of happiness, good luck and prosperity. The giraffe symbolizes the desire and ability to reach something far, unknown, craving for the desired.',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'name' => json_encode([
                    'ru' => 'Какие перспективы компании?',
                    'en' => 'What are the company\'s prospects?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Dinway только начинает свой путь и имеет масштабные планы по реализации крутых и востребованных IT- и социальных продуктов. Среди них:
                    <ul>
                        <li>создание системы мотивации сотрудников, что имеет черты бухгалтерской программы и банковского сервиса — PeopleUp;</li>
                        <li>создание площадки-посредника между стартапами и инвесторами;</li>
                        <li>CPA рекламная сеть и так далее.</li>
                    </ul>
                ',
                    'en' => 'Dinway is just beginning its journey and has large-scale plans to implement cool and popular IT and social products. Among them are:
                    <ul>
                        <li>creating an employee motivation system that has the features of an accounting program and a banking service-PeopleUp;</li>
                        <li>creating an intermediary platform between startups and investors;</li>
                        <li>CPA advertising network and so on.</li>
                    </ul>
                ',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'name' => json_encode([
                    'ru' => 'Как долго будет работать компания?',
                    'en' => 'How long will the company work?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Dinway не имеет никаких предпосылок к разговору о времени окончания работы, так как экономическая система и бизнес-модель компании работают оптимально и направлены на самые долгосрочные перспективы.',
                    'en' => 'Dinway does not have any prerequisites for talking about the end time of work, since the economic system and business model of the company work optimally and are aimed at the most long-term prospects.',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'name' => json_encode([
                    'ru' => 'Кто целевая аудитория проекта?',
                    'en' => 'Who is the target audience of the project?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Каждый человек сможет найти для себя подходящий продукт. А если вы не нашли продукт по душе, то предлагайте в службе поддержки продукт, которым вы хотели бы пользоваться и нам стоит его реализовать.',
                    'en' => 'Everyone will be able to find a suitable product for themselves. And if you do not find a product that you like, then offer the support service a product that you would like to use and we should implement it.',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'name' => json_encode([
                    'ru' => 'Как получить аудит бизнеса?',
                    'en' => 'How do I get a business audit?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Для получения аудита вам необходимо заполнить анкету и пройти личную консультацию с представителем компании. Детально с информацией об этом можно ознакомиться на странице <a class="question__link" href ="https://dinway.ai/businesspack">https://dinway.ai/businesspack</a>',
                    'en' => 'To get an audit, you need to fill out a questionnaire and go through a personal consultation with a company representative. More information about this can be found on the page <a class="question__link" href ="https://dinway.ai/businesspack">https://dinway.ai/businesspack</a>',
                ]),
                'category_id' => $categoryIdsByKey['popular'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 10,
                'name' => json_encode([
                    'ru' => 'Что такое BlogTime?',
                    'en' => 'What is BlogTime?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Услуга, позволяющая стать блогером всего за месяц, научиться позиционировать себя и продавать не продавая.',
                    'en' => 'Service that allows you to become a blogger in just a month, learn how to position yourself and sell without selling.',
                ]),
                'category_id' => $categoryIdsByKey['blogtime'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 11,
                'name' => json_encode([
                    'ru' => 'Чем полезен BlogTime?',
                    'en' => 'What is BlogTime useful for?',
                ]),
                'answer' => json_encode([
                    'ru' => 'С помощью программы ты сможешь использовать или создать свои конкурентные преимущества, вести блог, не зацикливаясь на контент-плане, получать удовольствие от ведения блога и от результатов, правильно позиционировать себя.',
                    'en' => 'With the help of the program, you will be able to use or create your competitive advantages, run a blog without focusing on the content plan, enjoy blogging and results, and position yourself correctly.',
                ]),
                'category_id' => $categoryIdsByKey['blogtime'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 12,
                'name' => json_encode([
                    'ru' => 'Что такое BusinessPack?',
                    'en' => 'What is BusinessPack?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Комплексное продвижение бизнеса всего за 3 шага с помощью современных маркетинговых инструментов. Детально о продукте на странице <a class="question__link" href ="https://dinway.ai/businesspack">https://dinway.ai/businesspack</a>.',
                    'en' => 'Comprehensive business promotion in just 3 steps with modern marketing tools. More information about the product on the page <a class="question__link" href ="https://dinway.ai/businesspack">https://dinway.ai/businesspack</a>.',
                ]),
                'category_id' => $categoryIdsByKey['business_pack'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 13,
                'name' => json_encode([
                    'ru' => 'Могу ли я упаковать или масштабировать свой бизнес с BusinessPack?',
                    'en' => 'Can I package or scale my business with BusinessPack?',
                ]),
                'answer' => json_encode([
                    'ru' => 'С продуктом BusinessPack вы сможете умножить вложения в несколько раз, начать использовать новые технологии, научитесь правильно делегировать задачи и обходить конкурентов.',
                    'en' => 'With the BusinessPack product, you can multiply your investments several times, start using new technologies, learn how to delegate tasks correctly and bypass competitors.',
                ]),
                'category_id' => $categoryIdsByKey['business_pack'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 14,
                'name' => json_encode([
                    'ru' => 'Какие дополнительные услуги предоставляет BusinessPack?',
                    'en' => 'What additional services does BusinessPack provide?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Разработка (создание посадочных страниц, корпоративных сайтов, интернет-магазинов, мобильных приложений), продвижение (упаковка социальных сетей, тергетированная и контекстная реклама, SEO-продвижение, разработка тунеллей продаж), дизайн (визуальная концепция бизнеса, контент для социальных сетей, презентации, веб-дизайн, стикеры, креативы), свидео-контент (монтаж, съёмка, сценарии, продюсирование).',
                    'en' => 'Development (creation of landing pages, corporate websites, online stores, mobile applications), promotion (packaging social networking targetirovanie and contextual advertising, SEO promotion, development Tunella sales), design (visual business concept, content for social networking, presentations, web design, stickers, creative), video content (shooting, editing, script, production).',
                ]),
                'category_id' => $categoryIdsByKey['business_pack'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 15,
                'name' => json_encode([
                    'ru' => 'Как работает Партнёрская программа?',
                    'en' => 'How does the Affiliate program work?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Партнёрская программа делится на два вида дохода: линейный и карьерный. Линейный доход приносит прибыль от депозита (суммы покупки инвестиционных пакетов) приглашенных инвесторов в размере 5% с первой линии, 3% со второй, 2% с третьей и по 1% с четвертой и пятой. Карьерный доход имеет фиксированный размер бонуса по достижению каждого карьерного уровня. Ознакомиться с таблицей карьерной программы можно на странице <a class="question__link" href ="https://dinway.ai/affiliate-program">https://dinway.ai/affiliate-program</a>.',
                    'en' => 'The Affiliate program is divided into two types of income: linear and career. Linear income brings profit of the Deposit (the amount of the purchase investment packages) invited investors in the amount of 5% from the first line, 3% second, 2% third 1% fourth and fifth. Career income has a fixed bonus amount for achieving each career level. You can view the table of the career program on the page <a class="question__link" href ="https://dinway.ai/affiliate-program">https://dinway.ai/affiliate-program</a>.',
                ]),
                'category_id' => $categoryIdsByKey['affiliate_program'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 16,
                'name' => json_encode([
                    'ru' => 'Чем уникально образование в Profi Universe?',
                    'en' => 'What is unique about education in Profi Universe?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Образование от Profi Universe позволяет получить профессиональные знания в различных областях бизнеса и прокачать личные качества для достижения новых высот.',
                    'en' => 'Education from Profi Universe allows you to gain professional knowledge in various areas of business and improve your personal qualities to reach new heights.',
                ]),
                'category_id' => $categoryIdsByKey['education'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 17,
                'name' => json_encode([
                    'ru' => 'Какие преимущества курса MLM UP 2.0?',
                    'en' => 'What are the advantages of the MLM UP 2.0 course?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Курс является самой результативной системой по развитию MLM-бизнеса в интернете. 91% студентов получают первых партнеров на 6-й день обучения. В результате вы перестанете навязываться людям, а они сами будут просить рассказать о бизнесе. Вы научитесь создавать интересный и уникальный контент для своей аудитории, который будет продавать 24/7, грамотно подавать рекламу в социальных сетях, создавать персональный бренд.',
                    'en' => 'The Course is the most effective system for the development of MLM business on the Internet. 91% of students receive their first partners on the 6th day of training. As a result, you will stop imposing on people, and they will ask you to tell them about the business. You will learn how to create interesting and unique content for your audience that will sell 24/7, competently serve ads in social networks, and create a personal brand.',
                ]),
                'category_id' => $categoryIdsByKey['education'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 18,
                'name' => json_encode([
                    'ru' => 'Для кого предназначен курс MLM UP 2.0?',
                    'en' => 'Who is the MLM UP 2.0 course for?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Курс подходит абсолютно каждому, кто желает развивать свою команду, научиться позиционировать себя, понять принципы прямых продаж с применением профессионального позиционирования.',
                    'en' => 'The Course is suitable for absolutely everyone who wants to develop their team, learn how to position themselves, understand the principles of direct sales using professional positioning.',
                ]),
                'category_id' => $categoryIdsByKey['education'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 19,
                'name' => json_encode([
                    'ru' => 'Чем отличается образование в ВУЗах и в Profi Universe?',
                    'en' => 'What is the difference between higher education And Profi Universe?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Образование от Profi Universe позволяет получить профессиональные знания в различных областях бизнеса и прокачать личные качества в относительно короткие сроки в режиме онлайн, что позволит вам максимально скоро добиваться результатов.',
                    'en' => 'Education from Profi Universe allows you to gain professional knowledge in various areas of business and improve your personal qualities in a relatively short time online, which will allow you to achieve results as soon as possible.',
                ]),
                'category_id' => $categoryIdsByKey['education'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 20,
                'name' => json_encode([
                    'ru' => 'Как работает Инвестиционная программа?',
                    'en' => 'How does the Investment program work?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Инвестиционная программа приносит прибыль каждому вкладчику на условиях инвестиционным пакетов, которые приобретал инвестор. С актуальной линейкой инвестиционных пакетов вы можете ознакомиться на странице <a class="question__link" href ="https://dinway.ai/investments">https://dinway.ai/investments</a>. Прибыль по инвестициям обеспечивается деятельностью компании по разработке IT-продуктов и услуг.',
                    'en' => 'The investment program brings profit to each investor on the terms of the investment packages that the investor purchased. The current line of investment packages can be found on the page <a class="question__link" href ="https://dinway.ai/investments">https://dinway.ai/investments</a>. Profit on investments is provided by the company\'s activities in the development of IT products and services.',
                ]),
                'category_id' => $categoryIdsByKey['investments'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 21,
                'name' => json_encode([
                    'ru' => 'Что такое Business Gaming?',
                    'en' => 'What is Business Gaming?',
                ]),
                'answer' => json_encode([
                    'ru' => 'IT-проекты для заработка в игровой форме.',
                    'en' => 'IT projects for earning money in a game form.',
                ]),
                'category_id' => $categoryIdsByKey['business_gaming'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 22,
                'name' => json_encode([
                    'ru' => 'Как можно зарабатывать с помощью Business Gaming?',
                    'en' => 'How can I earn money using Business Gaming?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Зарабатывайте на знаниях и навыках, либо испытайте удачу!',
                    'en' => 'Earn on knowledge and skills, or try your luck!',
                ]),
                'category_id' => $categoryIdsByKey['business_gaming'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 23,
                'name' => json_encode([
                    'ru' => 'Сколько можно зарабатывать с Graybull?',
                    'en' => 'How Much can I earn with Graybull?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Всё зависит от ваших знаний, умений, а иногда, может быть, и везения.',
                    'en' => 'It all depends on your knowledge, skills, and sometimes, maybe, luck.',
                ]),
                'category_id' => $categoryIdsByKey['graybull'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 24,
                'name' => json_encode([
                    'ru' => 'Сколько можно зарабатывать с Graybull?',
                    'en' => 'How Much can I earn with Graybull?',
                ]),
                'answer' => json_encode([
                    'ru' => 'Всё зависит от ваших знаний, умений, а иногда, может быть, и везения.',
                    'en' => 'It all depends on your knowledge, skills, and sometimes, maybe, luck.',
                ]),
                'category_id' => $categoryIdsByKey['graybull'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        echo "Rows: " . ($categoryRows + $questionRows) . "\n";
    }
}
