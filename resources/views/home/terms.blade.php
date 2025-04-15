@extends('home.base')
@section('content')
    <!-- page-title -->
    <section class="page-title centred">
        <div class="bg-layer" style="background-image: url({{asset('home/images/background/page-title.jpg')}});"></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>{{ $pageName }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $pageName }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->

    <!-- Page Title End -->
    <div class="terms-section pt-100 pb-100">
        <div class="container">
            <div class="terms-text">

                <p>Welcome to {{ $siteName }}! These terms and conditions outline the rules and regulations for the use of our banking services. By accessing or using our services, you agree to be bound by these terms. Please read them carefully.</p>

                <h2>1. Definitions</h2>
                <p>For the purpose of these terms:</p>
                <ul>
                    <li><strong>"Bank"</strong> refers to {{ $siteName }}.</li>
                    <li><strong>"Customer"</strong> refers to the individual or entity using our banking services.</li>
                    <li><strong>"Services"</strong> refers to the banking products and services provided by {{ $siteName }}, including but not limited to personal and business accounts, loans, online banking, and investment services.</li>
                </ul>

                <h2>2. Eligibility</h2>
                <p>To use our services, you must:</p>
                <ul>
                    <li>Be at least 18 years of age or the legal age of majority in your jurisdiction.</li>
                    <li>Provide accurate and complete information during account opening or service application.</li>
                    <li>Comply with all applicable laws and regulations.</li>
                </ul>

                <h2>3. Account Opening and Maintenance</h2>
                <ul>
                    <li>All account applications are subject to approval by {{ $siteName }}.</li>
                    <li>Customers must promptly notify the bank of any changes to their personal or business information.</li>
                    <li>The bank reserves the right to suspend or close accounts that are found to be in violation of these terms or any applicable laws.</li>
                </ul>

                <h2>4. Services Provided</h2>
                <p>{{ $siteName }} offers a range of banking services, including but not limited to:</p>
                <ul>
                    <li>Personal and business banking accounts.</li>
                    <li>Loan products such as personal loans, mortgages, and business loans.</li>
                    <li>Online and mobile banking services.</li>
                    <li>Investment and wealth management services.</li>
                    <li>Payment and money transfer services.</li>
                </ul>
                <p>The availability of services may vary based on location and other factors.</p>

                <h2>5. Fees and Charges</h2>
                <ul>
                    <li>Customers agree to pay all applicable fees and charges associated with the services they utilize.</li>
                    <li>Fee schedules are provided at the time of account opening and are available on our website.</li>
                    <li>{{ $siteName }} reserves the right to modify fees and charges with prior notice to customers.</li>
                </ul>

                <h2>6. Electronic Banking Services</h2>
                <p>When using our online or mobile banking services, customers agree to:</p>
                <ul>
                    <li>Maintain the confidentiality of their login credentials.</li>
                    <li>Notify the bank immediately of any unauthorized access or security breaches.</li>
                    <li>Ensure that their devices are secure and free from malware.</li>
                </ul>

                <h2>7. Limitation of Liability</h2>
                <p>{{ $siteName }} is not liable for:</p>
                <ul>
                    <li>Any indirect, incidental, or consequential damages arising from the use of our services.</li>
                    <li>Losses resulting from unauthorized access due to customer negligence.</li>
                    <li>Delays or failures in service delivery due to circumstances beyond our control, such as natural disasters or technical issues.</li>
                </ul>

                <h2>8. Confidentiality and Privacy</h2>
                <p>We are committed to protecting your privacy and handling your personal data in compliance with applicable privacy laws. </p>

                <h2>9. Changes to Terms</h2>
                <p>{{ $siteName }} reserves the right to modify these terms and conditions at any time. Changes will be effective upon posting on our website. Continued use of our services constitutes acceptance of the updated terms.</p>

                <h2>10. Governing Law</h2>
                <p>These terms and conditions are governed by the laws of our Jurisdiction. Any disputes arising from the use of our services will be resolved in the courts of our Jurisdiction.</p>

                <h2>11. Contact Us</h2>
                <p>If you have any questions or concerns about these terms, please contact us at:</p>
                <p>
                    <strong>Email:</strong> {{ $web->email }}<br>
                    <strong>Address:</strong> {{ $web->address }}<br>
                </p>

                <p>Thank you for choosing {{ $siteName }}. We look forward to serving you!</p>

            </div>
        </div>
    </div>


@endsection
