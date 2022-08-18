<script setup>
import {Head, Link, useForm, usePage} from '@inertiajs/inertia-vue3'
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import JetButton from '@/Components/Button.vue'
import JetInput from '@/Components/Input.vue'
import JetInputError from '@/Components/InputError.vue'
import JetCheckbox from '@/Components/Checkbox.vue'
import JetLabel from '@/Components/Label.vue'

defineProps({
    canResetPassword: Boolean,
    status: String,
})

const canRegisterAccount = !!usePage().props.value?.jetstream?.canRegisterAccount

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <Head title="Log in"/>

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo/>
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="email" value="Email"/>
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <JetInputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div class="mt-4">
                <JetLabel for="password" value="Password"/>
                <JetInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <JetInputError class="mt-2" :message="form.errors.password"/>
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <JetCheckbox v-model:checked="form.remember" name="remember"/>
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <span class="flex flex-col">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                          class="underline text-sm text-gray-600 dark:text-neutral-200 hover:text-gray-900 dark:text-neutral-50 dark:hover:text-gray-300">
                        Forgot your password?
                    </Link>
                    <Link v-if="canRegisterAccount" :href="route('register')"
                          class="underline text-sm text-gray-600 dark:text-neutral-200 hover:text-gray-900 dark:text-neutral-50 dark:hover:text-gray-300">
                        Don't have an account yet?
                    </Link>
                </span>

                <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </JetButton>
            </div>

            <div class="flex items-center justify-start mt-4">

            </div>
        </form>
    </JetAuthenticationCard>
</template>
