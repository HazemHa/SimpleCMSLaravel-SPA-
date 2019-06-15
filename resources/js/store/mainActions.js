export default {
    whoIAM({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            commit("whoIam", false);
        });
    }
}
