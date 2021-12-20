// Class for handling API requests
export class API_Request {
  constructor(nonce, type = 'application/json') {
    this.base_params = {
      headers: {
        'X-WP-Nonce': nonce,
      },
    }
    if (type) this.base_params.headers['Content-Type'] = type
    this.script = document.getElementById('starter-theme-js') // See hook in Functions
    this.api_endpoint = this.script.dataset.api
  }

  status_check(response) {
    // [TODO] Confirm if 500 and 400 errors need to be treated differently
    if (response.status >= 500) {
      // Error message?
      return false
    }
    if (response.status >= 400) {
      // Error message?
      return false
    }
    return true
  }

  async get(resource) {
    const params = {
      method: 'GET',
      ...this.base_params,
    }
    const request = await fetch(`${this.api_endpoint}/${resource}`, params)
    return request
  }

  async post(resource, data = {}) {
    const params = {
      method: 'POST',
      body: JSON.stringify(data),
      ...this.base_params,
    }
    const response = await fetch(`${this.api_endpoint}/${resource}`, params)
    if (!this.status_check(response)) return false
    return response
  }
}
