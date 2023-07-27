<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <div class="w-full py-2 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800">
                    <a href="#" class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        <img class="w-5 h-5 mr-2" src="{{ URL::to('/icons/api.svg') }}">
                        <div class="mx-1">
                            <h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200">API Documentation</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">How to use our API</p>
                        </div>
                    </a>

                    <hr class="border-gray-200 dark:border-gray-700 ">

                    <a href="#generateAPIKey" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        1. Generating API Key
                    </a>

                    <a href="#apiEndpoints" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        2. API Endpoints
                    </a>

                    <hr class="border-gray-200 dark:border-gray-700 ">

                    <a href="#apiCall" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        3. API Call
                    </a>

                    <a href="#apiResponses" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        4. API Responses
                    </a>
                </div>
            </div>

            <div class="lg:flex mt-2 col-span-12 md:col-span-10 lg:col-span-10 xl:col-span-10 w-full">
                <section class="dark:bg-gray-900 ">
                    <div class="container flex mx-auto">
                        <div class="w-2/3 md:w-full lg:w-full xl:w-full">
                            <p class="text-sm font-medium text-blue-500 dark:text-blue-400">Reference Documentation</p>
                            <h1 class="mt-3 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl"> API Documentation</h1>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">
                                Information within this guide will equip you with all the tools needed to make use of our API service, managed through your customer portal.
                                Some of our tutorials are in video format, as we believe the best way to learn is to watch it done, however, our documented sections will provide with all the required material you need to make use of your portal.
                            </p>

                        </div>
                    </div>
                    <div class="container flex mx-auto">
                        <div class="w-2/3 md:w-full lg:w-full xl:w-full">
                            <h1 class="mt-3 text-lg font-semibold text-blue-500 dark:text-blue-400"> Overview</h1>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">
                                Built into your customer portal, under the <strong>Security</strong> option, you can generate an APIKey to retrieve data from a URL, also known as an <strong>API endpoint</strong>.
                                The use of each endpoint is described in detail within this documentation including the parameters, requirements, endpoint responses and status codes.
                            </p>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                It is strongly advised that the mapping of data provided by the API is completed by an engineer experienced in ingestion of API data, however, should you require assistance from our development team,
                                please contact us on <strong>support@logisticsmartportal.com</strong>.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="generateAPIKey" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">Generate APIKey</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    API Keys are generated within the settings area of the customer portal. A user can generate a total of 5 API keys per account which can all be used at the same time.
                                    Please be aware that granting access to anyone outside your organisation can lead to a potential <strong>data breach</strong>.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    A user can quickly delete an API within the settings area by simply clicking the delete button within the table.
                                    Once a token is deleted it can no longer be used or retrieved.
                                </p>

                                <Video src='{{ URL::to('/images/illustrations/GenerateApiKey.mp4') }}' class="mt-4 rounded-lg border" controls trackSrc='flowbite.mp4'></Video>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Please see video tutorial on how to generate an API Key as well as the deletion of generated API Keys.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="apiEndpoints" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">API Endpoints</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    There are currently 5 API endpoints to call shipment data. The endpoint listed as getShipment is the <strong>Per Shipment API</strong> endpoint which is to be used to call shipments by reference.
                                    The endpoint listed as getAllShipments is a <strong>Get All Shipments</strong> endpoint which is to be used to retrieve all shipments.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">GET</span>
                                    https://logisticsmartportal.com/api/getAllShipments
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">POST</span>
                                    https://logisticsmartportal.com/api/getShipment
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">POST</span>
                                    https://logisticsmartportal.com/api/getShipmentByPO
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">POST</span>
                                    https://logisticsmartportal.com/api/getMilestones
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">POST</span>
                                    https://logisticsmartportal.com/api/getDeliveries
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="apiCall" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">API Calls</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    You can use the below tool to generate examples of API Calls and their responses. All of our API calls are in JSON format.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    1. API calls which are unauthenticated with return a message <strong>{"message":"Unauthenticated."}</strong> with the status of <strong>401</strong>.
                                    This is normally due to an unrecognized API Key.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    2. API calls which return <strong>{"[]"}</strong> with the status of <strong>200</strong> are due to an unrecognized <strong>ShipmentRef</strong> or <strong>ContainerNumber</strong>.
                                </p>

                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    3. API calls which return a status of <strong>404</strong> are due to an incorrect <strong>url address</strong>.
                                </p>

                                <div class="lg:flex mt-2 col-span-1 w-full md:col-span-2 lg:col-span-2 xl:col-span-2">
                                    <div class="min-w-96 mr-2 mt-2 mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select endpoint</label>
                                        <select wire:model="APIRequest" wire:change="changeVisual" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected value="empty">Select Endpoint</option>
                                            <option value="getAllShipments">Get All Shipments</option>
                                            <option value="getShipment">Get Shipment</option>
                                            <option value="getShipmentByPO">Get Shipment By PO</option>
                                            <option value="getMilestones">Get Milestones</option>
                                            <option value="getDeliveries">Get Deliveries</option>
                                        </select>
                                    </div>

                                    <div class="max-w-full mr-2 mt-2 mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <span class="inline-flex">
                                            @if($APIRequest == 'getAllShipments')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">GET</span>
                                            @elseif($APIRequest == 'getShipment')
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">POST</span>
                                            @endif
                                           {{ $url }}
                                        </span>
                                        <img src="{{ URL::to('/icons/json-file.svg') }}" class="h-7 w-7 m-2" />
                                        <pre class="left-0">
                                            {{ $APIPacket }}
                                        </pre>
                                    </div>
                                </div>

                                <div class="mt-2 col-span-1 w-full md:col-span-2 lg:col-span-2 xl:col-span-2">
                                    <div class="max-w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <img src="{{ URL::to('/icons/json-file.svg') }}" class="h-10 w-10 mb-2 justify-items-start" />
                                        <pre>{{ $APIResponse }}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div id="apiResponses" class="lg:flex lg:items-center lg:justify-between col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 border-b">
                <div class="lg:flex mt-2 col-span-10 w-full sm:col-span-12">
                    <section class="dark:bg-gray-900 mb-4">
                        <div class="container flex mx-auto">
                            <div class="w-full">
                                <h1 class="mt-3 text-lg font-semibold text-gray-800 dark:text-white md:text-lg">API Responses</h1>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">
                                    Our API Responses are nested arrays. The parent array will show shipment information <strong>Per Container</strong>, meaning, a shipment with multiple
                                    containers will return more than one nested json array.  Within the response array, there are two nested arrays which relate to <strong>Container Delivery</strong> information as well as a nested array displaying
                                    <strong>Container Tracking</strong> information. The below information will further explain the information within all arrays within the response.
                                </p>

                                <div class="lg:flex mt-2 col-span-1 md:col-span-3 lg:col-span-3 xl:col-span-3 w-full ">
                                    <div class="mr-2 mt-2 mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Shipment/Container Data</h2>
                                        <pre class="max-w-1/3">
                                            {{ $shipmentExample }}
                                        </pre>
                                    </div>
                                    <div class="mr-2 mt-2 mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Delivery Data</h2>
                                        <pre>
                                            {{ $deliveryExample }}
                                        </pre>
                                    </div>
                                    <div class="mr-2 mt-2 mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Milestone Data</h2>
                                        <pre>
                                            {{ $milestoneExample }}
                                        </pre>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
</div>
