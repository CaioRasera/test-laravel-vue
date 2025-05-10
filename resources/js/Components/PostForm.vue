<template>
  <div>
    <h2 class="text-xl font-bold mb-4">Criar Nova Postagem</h2>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <input
          v-model="form.title"
          type="text"
          placeholder="Título da postagem"
          class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200"
          required
        >
      </div>
      <div class="mb-4">
        <textarea
          v-model="form.content"
          rows="4"
          placeholder="Conteúdo da postagem"
          class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-200"
          required
        ></textarea>
      </div>
      <button
        type="submit"
        class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
        :disabled="loading"
      >
        Publicar Postagem
      </button>
      <div v-if="error" class="text-red-500 mt-2 text-sm">
        {{ error }}
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const emit = defineEmits(['post-created'])

const form = ref({
  title: '',
  content: ''
})
const error = ref('')
const loading = ref(false)

const submit = async () => {
  error.value = ''
  loading.value = true
  try {
    const res = await axios.post('/posts', form.value, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    form.value = { title: '', content: '' }
    emit('post-created', res.data.post)
  } catch (e) {
    error.value = e.response?.data?.message || 'Erro ao criar postagem.'
  }
  loading.value = false
}
</script>