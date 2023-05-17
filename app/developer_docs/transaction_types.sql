DELETE FROM `transaction_types`;

INSERT INTO `transaction_types` (`id`, `name_ru`, `name_en`, `name_de`, `name_zh`, `name_fr`, `name_pl`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ввод средств', 'Deposit', 'Einzahlung', '存款', 'Dépôt', 'Depozyt', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(2, 'Прибыль', 'Profit', 'Gewinn', '利潤', 'Le profit', 'Zysk', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(3, 'Реферальные ур. 1', 'Referral level 1', 'Überweisungsebene 1', '推薦你。1', 'Référence ur. 1', 'Twój polecony 1', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(4, 'Реферальные ур. 2', 'Referral level 2', 'Überweisungsebene 2', '推薦你。2', 'Référence ur. 2', 'Twój polecony 2', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(5, 'Реферальные ур. 3', 'Referral level 3', 'Überweisungsebene 3', '推薦你。3', 'Référence ur. 3', 'Twój polecony 3', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(6, 'Реферальные ур. 4', 'Referral level 4', 'Überweisungsebene 4', '推薦你。4', 'Référence ur. 4', 'Twój polecony 4', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(7, 'Реферальные ур. 5', 'Referral level 5', 'Überweisungsebene 5', '推薦你。5', 'Référence ur. 5', 'Twój polecony 5', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(8, 'Реферальные ур. 6', 'Referral level 6', 'Überweisungsebene 6', '推薦你。6', 'Référence ur. 6', 'Twój polecony 6', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(9, 'Реферальные ур. 7', 'Referral level 7', 'Überweisungsebene 7', '推薦你。7', 'Référence ur. 7', 'Twój polecony 7', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(10, 'Реферальные ур. 8', 'Referral level 8', 'Überweisungsebene 8', '推薦你。8', 'Référence ur. 8', 'Twój polecony 8', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(11, 'Реферальные ур. 9', 'Referral level 9', 'Überweisungsebene 9', '推薦你。9', 'Référence ur. 9', 'Twój polecony 9', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(12, 'Реферальные ур. 10', 'Referral level 10', 'Überweisungsebene 10', '推薦你。10', 'Référence ur. 10', 'Twój polecony 10', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(13, 'Заявка на вывод', 'Withdrawal request', 'Auszahlungsantrag', '提款請求', 'Demande de retrait', 'Żądanie wypłaty', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(14, 'Вывод', 'Withdrawal', 'Auszahlung', '結論', 'Conclusion', 'Wniosek', '2019-04-13 00:00:38', '2019-04-13 00:00:38', NULL),
(15, 'Бонусы', 'Bonuses', 'Boni', '獎金', 'Les bonus', 'Bonusy', '2019-05-24 07:24:00', '2019-05-24 07:24:00', NULL),
(16, 'Зарплата', 'Salary', 'Gehalt', '薪水', 'Le salaire', 'Wynagrodzenie', '2019-06-26 11:34:00', '2019-06-26 11:34:00', NULL),
(17, 'Месячные бонусы', 'Monthly bonuses', 'Monatliche Prämien', '每月獎金', 'Bonus mensuels', 'Miesięczne bonusy', '2019-06-27 03:00:00', '2019-06-27 03:00:00', NULL),
(18, 'Арбитражная торговля', 'Arbitration Trading', 'Schiedsgerichtsbarkeit', '仲裁交易', 'Trading d\'arbitrage', 'Handel arbitrażowy', '2019-07-13 04:24:00', '2019-07-13 04:24:00', NULL),
(19, 'Покупка плана арбитражной торговли', 'Buying an Arbitrage Trading Plan', 'Kauf eines Arbitrage-Handelsplans', '購買套利交易計劃', 'Achat d`un plan de négociation d`arbitrage', 'Kupowanie planu handlowego na arbitraż', '2019-07-13 07:00:00', NULL, NULL),
(20, 'Бонус при покупке арбитражного плана рефералом', 'Referral bonus when buying an arbitration plan', 'Empfehlungsbonus beim Kauf eines Schiedsgerichts', '購買仲裁計劃時的推薦獎金', 'Bonus de référence lors de l\'achat d\'un plan d\'arbitrage', 'Bonus za polecenie przy zakupie planu arbitrażowego', '2019-08-07 23:48:00', '2019-08-07 23:48:00', NULL),
(21, 'Покупка плана системы мотивации', 'Buying a Motivation System Plan', 'Kauf eines Motivationsplans', '購買激勵系統計劃', 'Achat d\'un plan de système de motivation', 'Zakup planu systemu motywacyjnego', '2019-08-14 15:22:00', '2019-08-14 15:22:00', NULL),
(22, 'Бонус к прибыли (мотивационная программа)', 'Bonus to profit (motivation program)', 'Bonus zum Profit (Motivationsprogramm)', '利潤獎勵（激勵計劃）', 'Bonus à gagner (programme de motivation)', 'Premia do zysku (program motywacyjny)', '2019-09-04 21:18:00', '2019-09-04 21:18:00', NULL),
(23, 'Бонус к реферальным начислениям (мотивационная программа)', 'Bonus to referral accruals (motivation program)', 'Bonus auf Empfehlungsrückstellungen (Motivationsprogramm)', '轉介應計獎勵（激勵計劃）', 'Bonus pour les versements effectués (programme de motivation)', 'Premia do rozliczeń międzyokresowych (program motywacyjny)', '2019-09-04 21:19:00', '2019-09-04 21:19:00', NULL),
(24, 'Перевод между аккаунтами', 'Transfer between accounts', 'Transfer zwischen Konten', '帳戶間轉帳', 'Virement entre comptes', 'Transfer między kontami', '2019-09-05 12:00:00', '2019-09-05 12:00:00', NULL),
(25, 'Перевод криптокошельков', 'Перевод криптокошельков', 'Перевод криптокошельков', 'Перевод криптокошельков', 'Перевод криптокошельков', 'Перевод криптокошельков', NULL, NULL, NULL),
(26, 'Прибыль в криптовалюте', 'Прибыль в криптовалюте', 'Прибыль в криптовалюте', 'Прибыль в криптовалюте', 'Прибыль в криптовалюте', 'Прибыль в криптовалюте', NULL, NULL, NULL),
(27, 'Инвестиции в маркетплейс', 'Инвестиции в маркетплейс', 'Инвестиции в маркетплейс', 'Инвестиции в маркетплейс', 'Инвестиции в маркетплейс', 'Инвестиции в маркетплейс', NULL, NULL, NULL),
(28, 'Продажа доли маркетплейса', 'Продажа доли маркетплейса', 'Продажа доли маркетплейса', 'Продажа доли маркетплейса', 'Продажа доли маркетплейса', 'Продажа доли маркетплейса', NULL, NULL, NULL),
(29, 'Инвестиции в маркетинг с основного баланса', 'Investment in marketing with a basic balance', 'Инвестиции в маркетинг с основного баланса', 'Инвестиции в маркетинг с основного баланса', 'Инвестиции в маркетинг с основного баланса', 'Инвестиции в маркетинг с основного баланса', NULL, NULL, NULL),
(30, 'Инвестиции в маркетинг с баланса коина', 'Coin Balance Marketing Investment', 'Инвестиции в маркетинг с баланса коина', 'Инвестиции в маркетинг с баланса коина', 'Инвестиции в маркетинг с баланса коина', 'Инвестиции в маркетинг с баланса коина', NULL, NULL, NULL),
(31, 'Перевод прибыли с маркетингового плана на основной счет', 'Перевод прибыли с маркетингового плана на основной счет', 'Перевод прибыли с маркетингового плана на основной счет', 'Перевод прибыли с маркетингового плана на основной счет', 'Перевод прибыли с маркетингового плана на основной счет', 'Перевод прибыли с маркетингового плана на основной счет', NULL, NULL, NULL),
(32, 'Прибыль от партнерской программы', 'Прибыль от партнерской программы', 'Прибыль от партнерской программы', 'Прибыль от партнерской программы', 'Прибыль от партнерской программы', 'Прибыль от партнерской программы', NULL, NULL, NULL),
(33, 'Перевод тела с маркетингового плана на основной счет', 'Перевод тела с маркетингового плана на основной счет', 'Перевод тела с маркетингового плана на основной счет', 'Перевод тела с маркетингового плана на основной счет', 'Перевод тела с маркетингового плана на основной счет', 'Перевод тела с маркетингового плана на основной счет', NULL, NULL, NULL),
(34, 'Депозитный процент', 'Deposit procent', 'Einzahlungsprozent', '存款保证金', 'Pourcentage de dépôt', 'Procent depozytu', NULL, NULL, NULL),
(35, 'Начислено через админ', 'Accrued through admin', 'Durch Admin entstanden', '通过管理员产生', 'Accru via admin', 'Naliczone przez administratora', NULL, NULL, NULL),
(36, 'Запрос на ввод монетой', 'Request deposit coin', 'Request deposit coin', 'Request deposit coin', 'Request deposit coin', 'Request deposit coin', NULL, NULL, NULL),
(37, 'Ввод монетой', 'Deposit coin', 'Deposit coin', 'Deposit coin', 'Deposit coin', 'Deposit coin', NULL, NULL, NULL);