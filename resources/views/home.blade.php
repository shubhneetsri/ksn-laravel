@extends('layouts.home')

@section('content')

<style>
    .detail{
        height:180px;
    }
    .pic_detail{
        width:100%;height: 322px;padding: 23px;
    }
</style>

<h2>Krishna Shishu Niketan</h2>
<p>Krishna Shishu Niketan provides classes from NC to VIIIth for children between the ages of 3 to 11 being brought up in Hindi and English medium environment. Many of the children have passed out from our school working in several good institutions. Krishna Shishu Niketan is a recognized by the government and was established in 1986. It is run by a team of administrators and fully trained B.ed qualified mother tongue teachers.<br /><br />
    Our teachers are all native Hindi and English speakers. They are qualified and are highly dedicated to creating a fun, friendly, but also hardworking environment at Krishna Shishu Niketan, Shahjahanpur. Some of our teachers some of are working professionals in diffrent industries.
</p>
<br>

<div class="row">

    <div class="column">
        <div class="card">
            <img src="/images/users/team2.jpg" alt="Mike" class="pic_detail">
            <div class="container">
                <h2 style="font-size: 20px;font-weight: bold;">Kiran Rekha</h2>
                <p class="title">Director</p>
                <p class="detail">Mr. kiran rekha is dedicated for this school community from past few years. She always been involved partially in school from the beginning of the school. She has conducted and supported the school staff as a mentor. She has also served as a principle in government school (Uttar Pradesh Junior High School) for many years school.</p>
                <p>kiranrekhaspn@gmail.com</p>
                <p><button class="button">Contact</button></p>
            </div>
        </div>
    </div>

    <div class="column">
        <div class="card">
            <img src="/images/users/team1.jpg" alt="Jane" class="pic_detail">
            <div class="container">
                <h2 style="font-size: 20px;font-weight: bold;">Rakesh Chandra Srivastava</h2>
                <p class="title">Co-Director</p>
                <p class="detail">Mr. Rakesh chandra srivastava is founder of the school. He is also a senior journalist in Times Of India newspaper. </p>
                <p>rakeshjeespn@gmail.com</p>
                <p><button class="button">Contact</button></p>
            </div>
        </div>
    </div>



    <div class="column">
        <div class="card">
            <img src="/images/users/team3.jpg" alt="Mike" class="pic_detail">
            <div class="container">
                <h2 style="font-size: 20px;font-weight: bold;">Mike Ross</h2>
                <p class="title">Art Director</p>
                <p class="detail">Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>example@example.com</p>
                <p><button class="button">Contact</button></p>
            </div>
        </div>
    </div>

    <!--<div class="column">
                    <div class="card">
                    <img src="/images/users/team2.jpg" alt="John" style="width:100%">
                    <div class="container">
                        <h2>John Doe</h2>
                        <p class="title">Designer</p>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>example@example.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                    </div>
                </div>-->
</div>

</div>
@endsection