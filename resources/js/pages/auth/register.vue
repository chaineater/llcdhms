<template>
  <div class="register-box">
    <div class="register-logo">
      HMS Admin
    </div>
    <div class="register-box-body">
      <p class="login-box-msg">Register a new membership</p>

      <form @submit.prevent="register" @keydown="form.onKeydown($event)">
        <!-- Name -->
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
          <div class="col-md-7">
            <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
            <has-error :form="form" field="name"/>
          </div>
        </div>

        <!-- Email -->
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
          <div class="col-md-7">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
            <has-error :form="form" field="email"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">User Type</label>
          <div class="col-md-7 ">
            <select v-model="form.userType" class="form-control select2">
              <option>Admin</option>
              <option>Doctor</option>
              <option>Pharmacist</option>
              <option>Nurse</option>
              <option>Lab Technician</option>
              <option>Clerk</option>
              <option>Cashier</option>
            </select>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
          <div class="col-md-7">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
            <has-error :form="form" field="password"/>
          </div>
        </div>

        <!-- Password Confirmation -->
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
          <div class="col-md-7">
            <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
            <has-error :form="form" field="password_confirmation"/>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-7 offset-md-3 d-flex">
            <!-- Submit Button -->
            <v-button :loading="form.busy">
              {{ $t('register') }}
            </v-button>

            <!-- GitHub Register Button -->
            <login-with-github/>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  layout: 'basic',
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      userType: 'Admin',
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Log in the user.
      const { data: { token } } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', { token })

      // Update the user.
      await this.$store.dispatch('auth/updateUser', { user: data })

      // Redirect home.
      this.$router.push({ name: 'dashboard' })
    }
  }
}
</script>
