=== 使い方 (How to Use) ======
1.  以下のプラグインをWordpressにインストールします。　（前回やってますね）
WP Session Manager
https://wordpress.org/plugins/wp-session-manager/

2. 添付のwhatiwantnext.zipはプラグインなので、解凍して、wordpress > wp-content > pluginsのフォルダの中に置いて下さい。　
置いたらWordpressのDashboardのPluginsで"What I Want Next"をActivateして下さい。

3. WordpressのDashboard > Pages > Add New でページを7つ（Form 1～7のぶん）作ってください。

4. Form1～7のページのPermalinkのURLをメモします。（page_idだけでなくURL全部）

5. Form1～7のページにそれぞれ以下の内容をコピペしてください。　next_page_url=の所にステップ4でメモった次のページのURLを書きます。

フォーム1　（ページ1）
Take three minutes to write down a list of responses to the question:
“By the end of my life, what do I want to have done?”
[form1 next_page_url=http://localhost/wordpress/?page_id=2]

フォーム2　（ページ2）
Take three minutes to list your responses to:
“By one year from today, what do I want to have done?”
[form2 next_page_url=http://localhost/wordpress/?page_id=3]

フォーム3　（ページ3）
Again, take no more than three minutes to write down your answers to:
“I just found out I have 30 days to live.
What do I want to have experienced in the final month of my life?”
[form3 next_page_url=http://localhost/wordpress/?page_id=4]

フォーム4　（ページ4）
Now, you can narrow down your list...
Check the three most important answers in each step.
[form4 form1='Life (Select 3 items)' form2='Year (Select 3 items)' form3='30-Days (Select 3 items)' next_page_url=http://localhost/wordpress/?page_id=5]

フォーム5　（ページ5）
<h2>Step 5</h2>
<h1>So far, your bucket list is as follows.
If you think you have too many list, you can uncheck to omit.</h1>
[form5 next_page_url=http://localhost/wordpress/?page_id=103 form5title='Check or Uncheck Items' form6text='Now, for each on the final list, block out one hour on your calendar next week to take at least one specific action toward accomplishing that goal. Write down the action you plan, plus the time and date.' mail_title='ここにメールのタイトルを書く' sender_email='ここに送り主のメールアドレスを書く']

“ If you cannot find one hour per week to work on something that you say is important to you, then how important can it really be?”

フォーム6　（ページ6）
Your Summary
[form6]


6. ステップ2で置いたプラグインフォルダの中の、whatiwantnext.phpを編集します。
14行目のカッコの中の数字をステップ2でメモったページIDに書き換えます。
if(!(is_page(1) || is_page(2) || is_page(3) || is_page(4) || is_page(5) || is_page(6) || is_page(7))){

同じように以下の場所のis_page()も直します。
34行目（フォーム1のID）
57行目（フォーム1のID）
63行目（フォーム2のID）
69行目（フォーム3のID）

7. Settings > General Settings で自分の場所（ホームページが公開される場所）のTimezoneを設定してください。
　　画面下の「Save Changes」をクリックしてください。

===============