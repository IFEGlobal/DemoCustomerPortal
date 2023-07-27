<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <div class="w-full py-2 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800">
                    <a href="#" class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        <img class="w-5 h-5 mr-2" src="{{ URL::to('/icons/api.svg') }}">
                        <div class="mx-1">
                            <h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Data Service Documentation</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">How to use our Data Service</p>
                        </div>
                    </a>

                    <hr class="border-gray-200 dark:border-gray-700 ">

                    <a href="#createService" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        1. Creating Data Services
                    </a>

                    <a href="#authentication" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        2. End Point Authentication
                    </a>

                    <a href="#statuses" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        3. Response Statuses
                    </a>

                    <a href="#modifyService" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        4. Modifying Data Services
                    </a>

                    <hr class="border-gray-200 dark:border-gray-700 ">

                    <a href="#eventLogs" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        5. Event Logs
                    </a>

                </div>
            </div>

            <div class="lg:flex mt-2 col-span-12 md:col-span-10 lg:col-span-10 xl:col-span-10 w-full">
                <section class="dark:bg-gray-900 ">
                    <div class="container flex mx-auto">
                        <div class="w-2/3 md:w-full lg:w-full xl:w-full">
                            <p class="text-sm font-medium text-blue-500 dark:text-blue-400">Reference Documentation</p>
                            <h1 class="mt-3 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl"> Data Service Documentation</h1>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">
                                Information within this guide will equip you with all the tools needed to make use of our Data Service, managed through your customer portal.
                                Some of our tutorials are in video format, as we believe the best way to learn is to watch it done, however, our documented sections will provide with all the required material you need to make use of your portal.
                            </p>

                        </div>
                    </div>
                    <div class="container flex mx-auto">
                        <div class="w-2/3 md:w-full lg:w-full xl:w-full">
                            <h1 class="mt-3 text-lg font-semibold text-blue-500 dark:text-blue-400"> Overview</h1>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">
                                Built into your customer portal, under the <strong>Data Service</strong> option, you can register a service to autonomously receive shipment events on creation or update to a URL, also known as an <strong>API endpoint</strong> managed by you.
                                Event data will consist of <strong>Shipment</strong> data on a container level, which also includes data relating to <strong>Deliveries</strong> as well as <strong>Container Tracking Milestones</strong>.
                            </p>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                It is strongly advised that the mapping of data provided by the Data Service is completed by an engineer experienced in ingestion of API data, however, should you require assistance from our development team,
                                please contact us on <strong>support@logisticsmartportal.com</strong>.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="createService" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">Creating Data Services</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    A Data Service is an API endpoint managed by you or your organisation which will be designed to ingest data, autonomously sent via the customer portal. The events are triggered when a component of the <strong>Shipment</strong>
                                    are changed or created.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    The portal user will need to test the data service URL within the data service creation function before storing the data. A failed status will still allow the user to create the service, however, the event logs will not be received until the
                                    endpoint is repaired or altered to accept data packets from the customer portal.
                                </p>

                                <Video src='{{ URL::to('/images/illustrations/create_delete_data_service.mp4') }}' class="mt-4 rounded-lg border" controls trackSrc='flowbite.mp4'></Video>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Please see video tutorial on how to test and register a <strong>Data Service</strong> within the Portal.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="authentication" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">End Point Authentication</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Your end point  may include some level of authentication such as an <strong>API Key</strong> or a <strong>Username and Password</strong>.
                                    These authentication parameters can be passed through to the registration by selecting the type of authentication and running a test to ensure that the status shows a successfully received response.
                                </p>

                                <Video src='{{ URL::to('/images/illustrations/authentication.mp4') }}' class="mt-4 rounded-lg border" controls trackSrc='flowbite.mp4'></Video>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Please see video tutorial on how to test and add <strong>Authentication</strong> to your data service within the Portal.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="statuses" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">Response Statuses</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    As you are required to test your <strong>Data Service</strong> end point before the system will allow you to register the service, it is good to understand what
                                    the response statuses mean. These statuses will also alert you to potentials issues with your <strong>Data Service</strong> end point.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    The status responses are more commonly known as <strong>HTTP</strong> responses. These responses are the statuses which are sent back to a sending server when making a <strong>HTTP</strong> request.
                                    These responses are split into 5 categories which determine what the type of response is, which could assist you in debugging the issues.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">100-109</span>
                                    <strong>Informational Responses</strong>
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">200-299</span>
                                    <strong>Successful Responses</strong>
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">300-399</span>
                                    <strong>Redirection Responses</strong>
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">400-499</span>
                                    <strong>Client Error Responses</strong>
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">500-599</span>
                                    <strong>Server Error Responses</strong>
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="modifyService" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">Modifying Services</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    You can <strong>Modify</strong> your <strong>Data Service</strong> using the table located below the registration form. Modifying the service will only allow
                                    you to amend the URL and the service name which is used as an identifying attribute when viewing <strong>Event Logs</strong> within the portal.
                                    Should you need to amend any security credentials, it is advised that you delete the current <strong>Data Service</strong> and create a new service to replace the current
                                    service. We do not show API credentials past the point of registration to ensure the security of sensitive information is kept secret.
                                </p>


                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    For additional security, on deletion of a data service <strong>Event Logs</strong> will no longer be accessible, therefore to migrate all logs to the current registered service,
                                    please contact <strong>support@logisticsmartportal.com</strong> and request the migration of <strong>Event Logs</strong>.
                                </p>

                                <Video src='{{ URL::to('/images/illustrations/edit-data-service.mp4') }}' class="mt-4 rounded-lg border" controls trackSrc='flowbite.mp4'></Video>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Please see video tutorial on how to modify your <strong>Data Service</strong> within the Portal.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="eventLogs" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">Event Logs</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                  <strong>Event Logs</strong> are the individual packets of data sent to you <strong>Data Service</strong> when a creation or update is detected within our system. These event logs are registered against a
                                    <strong>Data Service</strong> to enable the user to filter through events by service.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    The structure of an event log mimics the data structure of our API. This structure can be seen
                                    within the API documentation. A user will also be able to search event logs by date or by reference should you wish to interrogate the data sent. Within the events viewing page, it is also
                                    possible to preview the data in <strong>JSON</strong> format on an event level to examine the data.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Event data can <strong>NOT</strong> be resent to the <strong>Data Service</strong> due to the creation of events firing on an occurrence basis, therefore, should there be an issue with you end point it is advised that this is repaired at
                                    the earliest convenience so that any further events are picked up as they occur. An error can be detected within the events table by examining the <strong>SERVER STATUS</strong> and <strong>RESPONSE</strong> columns which will show the response
                                    status from your end point as well as the json response.
                                </p>

                                <Video src='{{ URL::to('/images/illustrations/view-data-event-logs.mp4') }}' class="mt-4 rounded-lg border" controls trackSrc='flowbite.mp4'></Video>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Please see video tutorial on how to view your <strong>Event Logs</strong> within the Portal.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
</div>
