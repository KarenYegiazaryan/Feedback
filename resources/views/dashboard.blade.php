<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Главная') }}
        </h2>
    </x-slot>
    <div class="py-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-message></x-message>
    </div>

    <!-- component -->
    @can('application-list')
        <div class="sm:px-6 w-full px-4 md:px-10 py-4 md:py-7">

            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                <div class="mt-3 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="focus:outline-none  h-16 border border-gray-100 rounded">
                        <tr class="mb-3">
                            <th class="pl-4">ID</th>
                            <th>Тема</th>
                            <th>Сообщение</th>
                            <th>Имя клиента</th>
                            <th>E-mail</th>
                            <th>Файл</th>
                            <th>Создано</th>
                            <th>Операции</th>
                        </tr>
                        </thead>
                        <tr class="h-3"></tr>
                        <tbody>
                        @forelse($applications as $app)
                            <tr tabindex="0" class="focus:outline-none  h-16 border border-gray-100 rounded">
                                <td class="pl-4">
                                    {{$loop->iteration}}
                                </td>
                                <td class="focus:text-indigo-600 ">
                                    <div class="flex items-center pl-5">
                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$app->topic}}</p>
                                    </div>
                                </td>
                                <td class="pl-24">
                                    <div class="flex items-center">
                                        <p class="text-sm leading-none text-gray-600 ml-2">{{substr($app->message,0,100)}}
                                            ...</p>
                                    </div>
                                </td>
                                <td class="pl-5">
                                    <div class="flex items-center">
                                        <p class="text-sm leading-none text-gray-600 ml-2">{{$app->fullname}}</p>
                                    </div>
                                </td>
                                <td class="pl-5">
                                    <div class="flex items-center">
                                        <p class="text-sm leading-none text-gray-600 ml-2">{{$app->email}}</p>
                                    </div>
                                </td>

                                <td class="pl-5">
                                    <div class="flex items-center">
                                        @if($app->media->first())
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 viewBox="0 0 20 20"
                                                 fill="none">
                                                <path
                                                    d="M12.5 5.83339L7.08333 11.2501C6.75181 11.5816 6.56556 12.0312 6.56556 12.5001C6.56556 12.9689 6.75181 13.4185 7.08333 13.7501C7.41485 14.0816 7.86449 14.2678 8.33333 14.2678C8.80217 14.2678 9.25181 14.0816 9.58333 13.7501L15 8.33339C15.663 7.67034 16.0355 6.77107 16.0355 5.83339C16.0355 4.8957 15.663 3.99643 15 3.33339C14.337 2.67034 13.4377 2.29785 12.5 2.29785C11.5623 2.29785 10.663 2.67034 10 3.33339L4.58333 8.75005C3.58877 9.74461 3.03003 11.0935 3.03003 12.5001C3.03003 13.9066 3.58877 15.2555 4.58333 16.2501C5.57789 17.2446 6.92681 17.8034 8.33333 17.8034C9.73985 17.8034 11.0888 17.2446 12.0833 16.2501L17.5 10.8334"
                                                    stroke="#52525B"
                                                    stroke-width="1.25"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                ></path>
                                            </svg>
                                            <a href="{{$app->media->first()->original_url}}" target="_blank"
                                               class="text-sm leading-none text-gray-600 ml-2">{{$app->media->first()->file_name}}</a>
                                        @endif
                                    </div>
                                </td>
                                <td class="pl-5">
                                    <button
                                        class="py-3 px-6 focus:outline-none text-sm leading-none text-gray-700 bg-gray-100 rounded">
                                        {{$app->created_at->format('d.m.Y H:i')}}
                                    </button>
                                </td>
                                <td class="pl-4">
                                    @if(!$app->read)
                                        <a href="{{route('applications.read',$app->id)}}"
                                           class="focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">
                                            Прочтено
                                        </a>
                                    @else
                                        <button
                                            class="focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-100 rounded hover:bg-green-200 focus:outline-none">
                                           Архив
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            <tr class="h-3"></tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="focus:outline-none  h-16 border border-gray-100 rounded text-center"> Нет
                                    Записей
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$applications->links()}}
                </div>
            </div>
        </div>
    @endcan

    @can('application-create')
    <!-- component -->
        <div class="flex  bg-gray-100">
            <div class="m-auto">
                <div>
                    <div class="mt-5 bg-white rounded-lg shadow">
                        <div class="flex">
                            <div class="flex-1 py-5 pl-5 overflow-hidden">
                                <h1 class="inline text-2xl font-semibold leading-none">Отправить заявку</h1>
                            </div>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="{{route('applications.store')}}">
                            @csrf
                            @method('POST')
                            <div class="px-5 pb-5">
                                    <div class="flex-grow w-full">
                                        <input placeholder="Тема" type="text" name="topic"
                                               class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                    <div class="flex-grow w-full">
                                        <input placeholder="E-mail" type="email" name="email"
                                               class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                <textarea name="message"
                                          placeholder="Сообщение"
                                          class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>

                                <div class="flex">
                                    <div class="flex-grow w-full ">
                                        <input type="file" name="file"
                                               class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow w-full">
                                <div class="flex-initial">
                                    <button type="submit"
                                            class="relative w-full flex justify-center items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-black rounded-md hover:bg-gray-900  focus:outline-none   transition duration-300 transform active:scale-95 ease-in-out">
                                        <span class="pl-2 mx-1">Отправить</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</x-app-layout>
