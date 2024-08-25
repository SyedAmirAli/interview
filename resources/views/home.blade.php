<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assignment</title>

    <style>
        input, select, textarea {
            --tw-ring-shadow: 0 !important;
        }
    </style>
    <script>
        var baseUrl = "{{ url('/api') }}";
    </script>

    <script src="{{ asset('/assets/js/vue.js') }}"></script>
    @vite('resources/css/app.css')
</head>
 
<body>
    <div id="app" class="w-full min-h-screen bg-white bg-gradient-to-tr flex flex-col items-center justify-center from-blue-300/10 to-purple-300/10 via-pink-300/10">
        <div class="container">
            <div class="from w-full flex items-center justify-center">
                <form action="/submit-form" v-on:submit="formHandler" :data-meta="isEdit ? 'edit' : 'create'" method="POST" class="p-10 bg-white border border-solid border-slate-200 rounded-3xl max-w-7xl w-full shadow-md">
                    <!-- General Information -->
                    <h3 class="text-2xl font-bold pb-2 border-b border-dashed border-slate-400 mb-4 text-slate-800 text-center">
                        @{{ isEdit ? 'Edit General Information' : 'Add New General Information' }}
                    </h3>
                
                    <div class="w-full flex gap-8">
                        <!-- Name (Text) -->
                        <div class="w-full">
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2">    
                                <label for="name" class="text-lg uppercase font-semibold text-slate-500">Name: <span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="text" id="name" name="name" {{-- required --}}
                                    {{-- :value="name.value" --}}
                                    {{-- v-on:input="(e)=> name.value = e.target.value" --}}
                                    v-model="name"
                                    placeholder="e.g. Jhon Doe"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] shadow-sm focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-4">    
                                <label for="email" class="text-lg uppercase font-semibold text-slate-500">E-mail:<span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="email" id="email" name="email" {{-- required --}}
                                    v-model="email"
                                    placeholder="e.g. example@gmail.com"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-4">    
                                <label for="phone" class="text-lg uppercase font-semibold text-slate-500">Phone Number<span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="text" id="phone" name="phone" {{-- required --}}
                                    v-model="phone"
                                    placeholder="e.g. 0********"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-4">    
                                <label for="date_of_birth" class="text-lg uppercase font-semibold text-slate-500">Date of Birth<span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="date" id="date_of_birth" name="date_of_birth" {{-- required --}}
                                    v-model="dateOfBirth"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-4 relative">    
                                <label for="country_" class="text-lg uppercase font-semibold text-slate-500">Country<span class="text-red-500 font-bold px-1">*</span></label>
                                <input v-on:click="handleActiveCountries" type="text" 
                                    placeholder="e.g. United State of America"
                                    autocomplete="off"
                                    v-on:input="countryChangeHandler" 
                                    :value="selectedCountry.name"
                                    name="country"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                                {{-- <input type="hidden" :value='JSON.stringify(selectedCountry)'  id="country" name="country"> --}}
                                <div :class="{hidden: !isActiveCountries}" class="absolute left-0 top-20 mt-3 z-10 w-full bg-slate-100 border border-solid border-slate-300 rounded-xl p-4">
                                    <ul class="w-full max-h-48 overflow-y-scroll flex flex-col gap-2">
                                        <li v-for="(country, index) in countriesRef" class="pr-3" v-on:click="handleActiveCountries(country, index)">
                                            <p class="w-full py-1 px-2 font-medium border border-solid border-slate-300 rounded-md duration-500 hover:bg-primary-main/10 hover:text-primary-main cursor-pointer bg-slate-50">@{{ country.name }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="w-full flex rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-3 relative gap-4">    
                                <label for="gender" class="text-lg uppercase font-semibold text-slate-500">Gender: <span class="text-red-500 font-bold px-1">*</span></label>
                                <div class="ml-6 flex gap-1 items-center justify-center">
                                    <input type="radio" id="male" name="gender" value="male" {{-- required --}} v-model="gender">
                                    <label for="male">Male</label>
                                </div>
                                <div class="ml-6 flex gap-1 items-center justify-center">
                                    <input type="radio" id="female" name="gender" value="female" v-model="gender">
                                    <label for="female">Female</label>
                                </div>
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-4">    
                                <label for="nid" class="text-lg uppercase font-semibold text-slate-500">National ID<span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="text" id="nid" name="nid" {{-- required --}} v-model="nid"
                                    placeholder="e.g. ********"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="w-full flex rounded-xl gap-2 bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mb-3">    
                                <div class="w-full flex flex-col">
                                    <label for="image" class="text-lg uppercase font-semibold text-slate-500">Profile Picture </label>
                                    <input type="file" id="image" name="image" v-on:change="imageHandler" ref="imageRef"
                                        class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                    />
                                </div>
                                <div class="relative" v-if="image">
                                    <img :src="makeImage()" :alt="name" width="80" height="80">
                                    <button class="absolute top-0 right-0 font-mono font-bold py-0.5 px-1.5 text-sm bg-red-400 rounded-full text-slate-100 duration-300 hover:bg-red-600" v-on:click="makeImage(true)">X</button>
                                </div>
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2">    
                                <label for="passport" class="text-lg uppercase font-semibold text-slate-500">Passport</label>
                                <input type="text" id="passport" name="passport"  v-model="passport"
                                    placeholder="e.g. ********"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>

                            <h3 class="mt-3 text-xl font-medium pb-1 border-b border-dashed border-primary-main/40">Account Information<span class="text-red-500 font-bold px-1">*</span></h3>

                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-3">    
                                <label for="bank_name" class="text-lg uppercase font-semibold text-slate-500">Bank Name<span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="text" id="bank_name" name="bank_name" 
                                    placeholder="e.g. Lorem Ispum" v-model="bankName"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-3">    
                                <label for="account_no" class="text-lg uppercase font-semibold text-slate-500">Account Number<span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="text" id="account_no" name="account_no" 
                                    placeholder="e.g. ********" v-model="accountNo"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-3">    
                                <label for="ibn" class="text-lg uppercase font-semibold text-slate-500">IBN<span class="text-red-500 font-bold px-1">*</span></label>
                                <input type="text" id="ibn" name="ibn" 
                                    placeholder="e.g. ********" v-model="ibn"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                />
                            </div>
                        
                            <div class="w-full flex flex-col rounded-xl bg-slate-50 border border-dashed border-slate-200 px-4 py-2 mt-3">    
                                <label for="accountType" class="text-lg uppercase font-semibold text-slate-500">Account Type<span class="text-red-500 font-bold px-1">*</span></label>
                                <select id="accountType" name="accountType" {{-- required --}} v-model="accountType"
                                    class="bg-slate-100 rounded-md outline-none ring-[0] focus:border-primary-main border border-solid border-slate-300" 
                                >
                                    <option value="">Select account type</option>
                                    <option value="savings">Savings</option>
                                    <option value="checking">Student</option>
                                    <option value="checking">Business</option>
                                </select>
                            </div>

                            <div class="w-full mt-5 flex items-center justify-end gap-6" v-if="isEdit">
                                <button type="submit" role="button" class="bg-primary-main text-lg text-slate-100 font-medium px-6 py-2 rounded-md hover:tracking-wide duration-500">Update Information</button>
                                <button role="button" class="bg-red-500 text-lg text-slate-100 font-medium px-6 py-2 rounded-md hover:tracking-wide duration-500" v-on:click="cancelGeneralInformationHandler">cancel</button>
                            </div>

                            <div class="w-full mt-5 flex items-center justify-end" v-else>
                                <button role="button" class="bg-blue-500 text-lg text-slate-100 font-medium px-6 py-2 rounded-md hover:tracking-wide duration-500">Add Information</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

        <div class="w-full flex items-center justify-center mt-6 p-4">
            <div class="w-full border-t border-solid border-primary-main"></div>
            <h3 class="text-xl font-semibold px-3 text-nowrap">List of Information</h3>
            <div class="w-full border-t border-solid border-primary-main"></div>
        </div>

        <div class="p-4 w-full">
            <table class="w-full mb-10" v-if="generalsInformation.length > 0">
                <thead>
                    <tr>
                        {{-- <th v-for="title in itemsTitle">@{{ title }}</th> --}}
                        <th class="border border-solid border-slate-400">Name & Gender</th>
                        <th class="border border-solid border-slate-400">Email & Phone</th>
                        <th class="border border-solid border-slate-400">Date of Birth & Country</th>
                        <th class="border border-solid border-slate-400">Passport & National ID</th>
                        <th class="border border-solid border-slate-400">Bank Name & Account No.</th>
                        <th class="border border-solid border-slate-400">Account Type & IBN</th>
                        <th class="border border-solid border-slate-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="information in generalsInformation" class="border border-solid border-slate-400">
                        <td class="p-1 flex gap-1 w-full justify-between">
                            <p>
                                @{{ information.name }} <br />
                                @{{ information.gender }}     
                            </p> 
                            <img v-if="information.image" :src="asset+information.image" width="50" height="50" alt="information.name">
                        </td>
                        <td class="p-1 border border-solid border-slate-400">
                            @{{ information.phone }} <br />
                            @{{ information.email }}  
                        </td>
                        <td class="p-1 border border-solid border-slate-400">
                            @{{ information.date_of_birth }} <br />
                            @{{ information.country_name }} (@{{ information.country_code }})  <br />
                        </td>
                        <td class="p-1 border border-solid border-slate-400">
                            @{{ information.passport }} <br />
                            @{{ information.nid }}
                        </td>
                        <td class="p-1 border border-solid border-slate-400">
                            @{{ information.bank_name }} <br />
                            @{{ information.account_no }}
                        </td>
                        <td class="p-1 border border-solid border-slate-400">
                            @{{ information.account_type }} <br />
                            @{{ information.ibn }}
                        </td>
                        <td class="p-1 flex justify-evenly h-full">
                            <button class="mt-2.5 uppercase font-mono font-medium py-0.5 px-2.5 text-sm bg-yellow-400 rounded-full text-slate-900 duration-300 hover:bg-yellow-600" 
                                v-on:click="editGeneralInformationHandler(information)"
                            >
                                edit
                            </button>
                            <button class="mt-2.5 uppercase font-mono font-medium py-0.5 px-2.5 text-sm bg-red-400 rounded-full text-slate-100 duration-300 hover:bg-red-600"
                                v-on:click="deleteHandler(information.id)"
                            >delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="w-full flex items-center justify-center" v-else>
                <p class="text-xl text-slate-500 font-medium p-4">No Information Found. Please add one!</p>
            </div>
        </div>

        <div v-if="toast.status" class="w-full fixed top-0 left-0 flex items-end justify-end z-20 pr-4 pt-4">
            <div class="p-6 flex items-center justify-center gap-3 bg-white shadow-md rounded-lg border border-solid border-slate-300">
                <p class="text-nowrap text-lg font-medium break-all" 
                    :class="{'text-red-500': toast.type === 'error', 'text-yellow-500': toast.type === 'warning', 'text-green-500': toast.type === 'success', }">
                    @{{ toast.text || 'Server Error!' }}
                </p>
                <button class="font-mono font-bold py-1 px-2.5 bg-red-400 rounded-full text-slate-100 duration-300 hover:bg-red-600" v-on:click="closeToast">X</button>
            </div>
        </div>
    </div>

    <!-- Usage OF Vue.js -->
    <script>
        const { createApp, ref, watch } = Vue;
        const lowercaseStr = str => str.toLowerCase().replace(/\s+/g, '');
        
        const app = Vue.createApp({
            setup(){
                const asset = ref("{{ asset('/') }}");
                const countriesArray = Object.values(@json($countries));
                const generalsInformation = ref(@json($generalsInformation));

                const countriesRef = ref(countriesArray);
                const isActiveCountries = ref(false);
                const selectedCountry = ref({ code:'', name:'', index:undefined });

                // laravel csrf token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const headers = {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json', // Ensure the request expects JSON response
                };

                // for notification toast
                const toast = ref({
                    status: false,
                    type: "error",
                    text: "Server Error!",
                });

                // Function to reset the status after 5 seconds
                function resetToastStatus() {
                    setTimeout(() => {
                        toast.value.status = false;
                    }, 5000); // 5000 milliseconds = 5 seconds
                }

                function closeToast(){
                    toast.value.status = false;
                }

                // Call the function to reset the status
                // resetToastStatus();
                watch(() => toast.value.status, (generalsInformation) => {
                    if (generalsInformation) {
                        resetToastStatus();
                    }
                });

                // form inputs
                const id = ref(null);
                const name = ref("");
                const email = ref("");
                const phone = ref("");
                const dateOfBirth = ref("");
                const gender = ref("");
                const image = ref(null);
                const passport = ref("");
                const bankName = ref("");
                const accountNo = ref("");
                const ibn = ref("");
                const nid = ref("");
                const accountType = ref("");

                // external
                const isEdit = ref(false);
                const isImageDelete = ref(0);
                

                // clear the all the inputs 
                function clearInputs(){
                    id.value = null;
                    name.value = "";
                    email.value = "";
                    phone.value = "";
                    dateOfBirth.value = "";
                    gender.value = "";
                    image.value = null;
                    passport.value = "";
                    bankName.value = "";
                    accountNo.value = "";
                    ibn.value = "";
                    nid.value = "";
                    accountType.value = "";
                    selectedCountry.value.name = "";
                    selectedCountry.value.code = "";
                    document.querySelector('form').reset();
                }

                // image input handler
                function imageHandler(event){
                        isImageDelete.value = 0;
                        image.value = event.target.files[0];
                }

                async function formHandler(event){
                    event.preventDefault();
                    const type = event.target.getAttribute('data-meta');

                    if(type === 'create') {
                        const result =   await sendFormData(event, baseUrl+'/general-information/create');
                        if(result?.status === 'success') {
                            clearInputs();
                            isEdit.value = false;
                            generalsInformation.value.unshift(result?.data)
                        };
                    };

                    if(type === 'edit') {
                        const result =  await sendFormData(event, `${baseUrl}/general-information/${id.value}/update`);
                        if(result?.status === 'success'){
                            clearInputs();
                            isEdit.value = false;
                            generalsInformation.value = generalsInformation.value.map(information => information?.id === result?.data?.id ? result?.data : information);
                        }
                    };
                }

                // delete function
                async function deleteHandler(id){
                    const conf = confirm('Are you sure to delete this information for permanently!')
                    console.log({id,conf})
                    if(conf){
                        const response = await fetch(`${baseUrl}/general-information/${id}/delete`, {
                            method:'DELETE', headers
                        });

                        const result = await response.json();

                        if(response.ok){
                            toast.value.status = true;
                            toast.value.text = result?.message;
                            toast.value.type = 'success';
                        } else {
                            toast.value.status = true;
                            toast.value.text = result?.message;
                            toast.value.type = result?.status === 'error' ? 'error' : 'warning';
                        }
                        
                        if(result?.status === 'success'){
                            generalsInformation.value = generalsInformation.value.filter(information => information?.id !== id);
                        }
                    }
                }

                // send form data from client to server
                async function sendFormData(event, url, method = 'POST'){
                    event.preventDefault();

                    const formData = new FormData();
                    formData.append('name', name.value);
                    formData.append('email', email.value);
                    formData.append('phone', phone.value);
                    formData.append('dateOfBirth', dateOfBirth.value);
                    formData.append('gender', gender.value);
                    formData.append('image', image.value);
                    formData.append('passport', passport.value);
                    formData.append('bankName', bankName.value);
                    formData.append('accountNo', accountNo.value);
                    formData.append('ibn', ibn.value);
                    formData.append('accountType', accountType.value);
                    formData.append('nid', nid.value);
                    formData.append('countryName', selectedCountry.value.name);
                    formData.append('countryCode', selectedCountry.value.code);
                    formData.append('isImageDelete', isImageDelete.value);

                    // send api request to a general information
                    try {
                        const response = await fetch(url, {
                            method,
                            headers,
                            body: formData,
                        });

                        const result = await response.json();

                        if(response.ok){
                            toast.value.status = true;
                            toast.value.text = result?.message;
                            toast.value.type = 'success';
                        } else {
                            toast.value.status = true;
                            toast.value.text = result?.message;
                            toast.value.type = result?.status === 'error' ? 'error' : 'warning';
                        }

                        return result;
                    } catch (error) {
                        console.log(error)
                    }

                    return { status: 'error' };
                }
                
                // filter the countries by search
                function countryChangeHandler(event){
                    isActiveCountries.value = true;
                    selectedCountry.value.name = event.target.value;
                    countriesRef.value = countriesArray.filter(function(country){
                        return lowercaseStr(country.name).includes(lowercaseStr(event.target.value));
                    })
                }

                function handleActiveCountries(country={},index=null){
                    selectedCountry.value = {...country, index};
                    isActiveCountries.value = !isActiveCountries.value;
                }

                // edit functionalities
                function cancelGeneralInformationHandler(event){
                    event.preventDefault();

                    isEdit.value = false;
                    clearInputs();
                }

                function editGeneralInformationHandler(data){
                    isEdit.value = true;
                    
                    id.value = data.id;
                    name.value = data.name;
                    email.value = data.email;
                    phone.value = data.phone;
                    dateOfBirth.value = data.date_of_birth;
                    gender.value = data.gender;
                    image.value = data.image;
                    passport.value = data.passport;
                    bankName.value = data.bank_name;
                    accountNo.value = data.account_no;
                    ibn.value = data.ibn;
                    nid.value = data.nid;
                    accountType.value = data.account_type;
                    selectedCountry.value.name = data.country_name
                    selectedCountry.value.code = data.country_code

                    // console.log(data)
                }

                function makeImage(cancel = false){
                    // console.log(image.value)

                    if(cancel){
                        image.value = null;
                        isImageDelete.value = 1;
                        return null;
                    }

                    if(typeof image.value === 'string'){
                        return asset.value + image.value;
                    }

                    if(image.value !== null && Object.isExtensible(image.value)){
                        return URL.createObjectURL(image.value);
                    }

                    return null;
                }

                return {
                    countriesRef,
                    countryChangeHandler,
                    isActiveCountries,
                    handleActiveCountries,
                    selectedCountry,
                    name,
                    email,
                    phone,
                    dateOfBirth,
                    gender,
                    image,
                    passport,
                    bankName,
                    accountNo,
                    ibn,
                    accountType,
                    nid,
                    imageHandler,
                    toast,
                    closeToast,
                    formHandler, 
                    editGeneralInformationHandler, 
                    cancelGeneralInformationHandler, 
                    generalsInformation,isEdit,asset,
                    makeImage,deleteHandler
                }
            }
        });

        app.mount("#app");
    </script>
</body>
</html>