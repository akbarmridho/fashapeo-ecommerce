class AuthCheck {
    async adminCheck() {
        let authenticated;
        await window.axios.get("/auth/admin").then((response) => {
            authenticated = Boolean(response);
        });
        return authenticated;
    }

    async customerCheck() {
        let authenticated;
        await window.axios.get("/auth/customer").then((response) => {
            authenticated = Boolean(response);
        });
        return authenticated;
    }
}

export default AuthCheck;
