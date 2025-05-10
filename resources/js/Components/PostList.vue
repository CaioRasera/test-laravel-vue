<template>
  <div>
    <div v-for="post in posts" :key="post.id" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition mb-6">
      <div class="flex justify-between items-start">
        <div>
          <h3 class="text-xl font-bold text-gray-800">{{ post.title }}</h3>
          <p class="mt-2 text-gray-700">{{ post.content }}</p>
          <p class="mt-2 text-sm text-gray-500">
            Por: {{ post.user.name }} em {{ formatDate(post.created_at) }}
          </p>
        </div>
        <div v-if="isAdmin" class="flex flex-col gap-2 ml-4">
          <button
            @click="deletePost(post)"
            class="px-3 py-1 bg-red-500 text-white rounded text-sm hover:bg-red-600 transition"
          >
            Excluir
          </button>
        </div>
      </div>
    </div>
    <div v-if="posts.length === 0" class="text-center text-gray-500 py-8">
      Nenhum post encontrado.
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const props = defineProps({
  posts: Array,
  isAdmin: Boolean
})

const emit = defineEmits(['post-deleted'])

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString()
}

const deletePost = async (post) => {
  if (!confirm('Tem certeza que deseja apagar este post?')) return
  try {
    await axios.delete(`/posts/${post.id}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    emit('post-deleted', post.id)
  } catch (error) {
    alert('Erro ao apagar post.')
  }
}
</script>