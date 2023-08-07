@extends('layouts.app')

@section('content')
<div class="min-h-[90vh]">
    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class=" text-center mt-16">
            <span class="box-decoration-clone rounded-3xl bg-gradient-to-r from-indigo-600 to-pink-500 text-white px-3 py-2">
                About<br>
                <hr>
                Site!
            </span>

        </div>

        <div class="mx-auto">
            <div>
                <div class="flex flex-wrap">
                    <div class="w-full min-h-[80vh] flx flex-col  rounded-3xl ">
                        <div class="card p-2 md:p-10 rounded-3xl drop-shadow-xl overflow-hidden flex-1 flex flex-col items-center">
                            <div class="mb-9 w-full sm:container mx-auto">
                                <div class="pt-[0rem]">
                                    <div class="card bg-white my-12 p-5">
                                        <div class="shadow-none">
                                            <h1 class="font-extrabold text-2xl leading-8 text-slate-900">
                                                ABOUT SITE
                                            </h1>
                                            <div class="my-1">
                                                <p class="leading-normal text-slate-900 text-justify">
                                                    <!-- The -->
                                                    <Link href="https://DareShare.in/" as="https://DareShare.in/">
                                                    <span class="mx-1 cursor-pointer text-blue-700 hover:text-blue-800">
                                                        https://DareShare.in/
                                                    </span>
                                                    </Link>
                                                    <!-- was created to provide Festival information to people
                                                    all over the world. A platform where anyone can check
                                                    when it will start and end, as well as other pertinent
                                                    information. We love hearing from you because it was
                                                    created for you. So, if you notice any errors, please
                                                    email us and we will correct them as soon as possible.
                                                    We are attempting to cover almost all festival
                                                    information, but if any festivals are missing, please
                                                    email us and we&apos;ll add them. Please help us grow by
                                                    sharing and believing in us. -->
                                                </p>
                                                <br></br>
                                                <p class="leading-normal text-slate-900 text-justify">
                                                    I wish you lots of happiness, love, joy, laughter, and
                                                    smiles!
                                                </p>

                                                <p class="leading-normal text-slate-900 text-justify">
                                                    Keep Enjoying
                                                </p>
                                                <br></br>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
