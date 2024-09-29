@extends('layouts.client')

  
@section('title', 'Trang chính sách')

@section('content')
    @session('success')
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endsession

    <div class=" mx-3 mt-3  card">
        {{-- chính sách giao hàng --}}
        <div class=" mx-4 mt-4">

            <div class="">
    
                <p class="font-bold text-sm md:text-base lg:text-lg">CHÍNH SÁCH GIAO HÀNG</p>
                <div class="">
                    <p class="font-bold text-xs mt-3 md:text-sm md:mt-4 lg:text-lg">1. The Ladybugs Pizza Vietnam serves customers through</p>
                    <p class="text-xs md:text-sm  lg:text-lg">The Ladybugs Pizza may collect personal information from customers including full name, address, ID and mobile phone number, email address, credit card details and any other information if you agree to provide us with this information. This information will appear when customers: <br>
                        - Log in to The Ladybugs Pizza website;<br>
                        - Enter contests and promotions;<br>
                        - Participate in surveys according to the survey programs of The Ladybugs Pizza and any partners of The Ladybugs Pizza (if any);<br>
                        - Send an email to The Ladybugs Pizza;<br>
                        - Sign up for membership of The Ladybugs Pizza;<br>
                        - Respond to customer requests;
                        - Order pizza at The Ladybugs Pizza stores nationwide or on The Ladybugs Pizza's website;<br>
                        If The Ladybugs Pizza collects your personal information from someone else, The Ladybugs Pizza will take reasonable steps to notify the customer.
                    </p>
                </div>
                <div class="">
                    <p class="font-bold text-xs mt-3 md:text-sm md:mt-4  lg:text-lg">2. The Ladybugs Pizza's purpose in using the collected information:</p>
                    <p class="text-xs  md:text-sm  lg:text-lg">
                        The Ladybugs Pizza may use the personal information provided by customers and process such information to provide goods and services to customers, and to carry out programs of The Ladybugs Pizza and/or its partners provided that these programs are conducted openly and transparently. Generally, we will use such personal information in the way that customers wish, including but not limited to, for any of the following purposes: <br>
                        - Manage website members if you have registered as a member<br>
                        - Provide customers with any information about the company that they request;<br>
                        - Process orders via website;<br>
                        - Determine the number of customers visiting the website;<br>
                        - Prize announcements and purchases;<br>
                        - Respond to specific customer requests;<br>
                        - Notify customers of changes on the website;<br>
                        - Manage marketing research programs;<br>
                        - Send customers promotions or information about products and services that we consider beneficial to customers;<br>
                        Any other programs related to the above content and/or support, providing other utilities to customers through The Ladybugs Pizza's programs and The Ladybugs Pizza's partners.<br><br>
                    
                        Other information related to the use of customers' personal information when customers use our online ordering system:<br>
                        When customers use the online ordering system, they need to answer additional information requests if they order pizza online. This information helps deliver pizza to the customer's home easily, quickly, and accurately. The online ordering system will also store information about the customer's order to help customers remember and reorder the menu for the next purchase.<br>
                    
                        In addition, The Ladybugs Pizza has the right to use personal information collected from the website for other purposes as follows:<br>
                        - User setup and authentication;<br>
                        - Open, maintain, administer and preserve customer or member accounts;<br>
                        - Handle, preserve & respect communications;<br>
                        - Supportor users;<br>
                        - Upgrade the website, including meeting user needs;<br>
                        Provide users with product and service updates, promotions and other information from The Ladybugs Pizza and its affiliates;<br>
                        - Respond to customer questions, comments and instructions;<br>
                        - Maintain system security & safety;<br>
                        - Other activities related to the above activities.
                    </p>
                </div>
                <div class="">
                    <p class="font-bold text-xs mt-3 md:text-sm md:mt-4  lg:text-lg">3. Who does The Ladybugs Pizza share information with?</p>
                    <p class="text-xs  md:text-sm  lg:text-lg">The Ladybugs Pizza will not provide any personal information of customers to third parties unrelated to The Ladybugs Pizza and will not allow any third parties to use this information to market directly to customers. The Ladybugs Pizza may use related companies to operate and maintain the website or for other purposes related to its business activities, and these companies will receive customer information to carry out the above requests of The Ladybugs Pizza. The Ladybugs Pizza has the right to share customer personal information in some cases when government agencies have information requests, serve investigation purposes or other requests as prescribed by law. <br><br>

                        Personal information that customers have registered on the website may be shared with third parties of The Ladybugs Pizza:<br>
                        - Suppliers hired by us to provide certain services such as sending mail to customers;<br>
                        - To meet the customer's purpose when registering personal information;<br>
                        - If the customer agrees to share this personal information;<br>
                        - If the government requests to share this personal information;<br>
                        - If the customer's personal information is collected by a marketing unit, it will be provided to this marketing unit for research & marketing purposes;<br>
                    </p>
                </div>
            </div>
           {{-- end chính sách giao hàng --}}
    
    
           {{-- chính sách bảo mật --}}
           <div class="mt-3 mb-2 md:mb-4 md:mt-7">
    
            <p class="font-bold text-sm  md:text-base lg:text-lg">CHÍNH SÁCH BẢO MẬT </p>
            <div class="">
                <p class="font-bold text-xs mt-3 md:text-sm md:mt-4 lg:text-lg">1. The Ladybugs Pizza Vietnam serves customers through</p>
                <p class="text-xs md:text-sm lg:text-lg">The Ladybugs Pizza may collect personal information from customers including full name, address, ID and mobile phone number, email address, credit card details and any other information if you agree to provide us with this information. This information will appear when customers: <br>
                    - Log in to The Ladybugs Pizza website;<br>
                    - Enter contests and promotions;<br>
                    - Participate in surveys according to the survey programs of The Ladybugs Pizza and any partners of The Ladybugs Pizza (if any);<br>
                    - Send an email to The Ladybugs Pizza;<br>
                    - Sign up for membership of The Ladybugs Pizza;<br>
                    - Respond to customer requests;<br>
                    - Order pizza at The Ladybugs Pizza stores nationwide or on The Ladybugs Pizza's website;<br>
                    If The Ladybugs Pizza collects your personal information from someone else, The Ladybugs Pizza will take reasonable steps to notify the customer.
                </p>
            </div>
            <div class="">
                <p class="font-bold text-xs mt-3 md:text-sm md:mt-4 lg:text-lg">2. The Ladybugs Pizza's purpose in using the collected information:</p>
                <p class="text-xs md:text-sm lg:text-lg">
                    The Ladybugs Pizza may use the personal information provided by customers and process such information to provide goods and services to customers, and to carry out programs of The Ladybugs Pizza and/or its partners provided that these programs are conducted openly and transparently. Generally, we will use such personal information in the way that customers wish, including but not limited to, for any of the following purposes: <br>
                    - Manage website members if you have registered as a member<br>
                    - Provide customers with any information about the company that they request;<br>
                    - Process orders via website;<br>
                    - Determine the number of customers visiting the website;<br>
                    - Prize announcements and purchases;<br>
                    - Respond to specific customer requests;<br>
                    - Notify customers of changes on the website;<br>
                    - Manage marketing research programs;<br>
                    - Send customers promotions or information about products and services that we consider beneficial to customers;<br>
                    Any other programs related to the above content and/or support, providing other utilities to customers through The Ladybugs Pizza's programs and The Ladybugs Pizza's partners.
                </p>
            </div>
         
        </div>
           {{-- end chính sách bảo mật --}}
        
        </div>


    </div>

@endsection
